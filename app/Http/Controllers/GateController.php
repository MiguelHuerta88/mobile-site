<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Exception;

abstract class GateController extends Controller
{
    /**
     * try update
     *
     * @param $id
     * @param array $attributes
     * @param Model $model
     * @param bool $shouldValidate
     * @return array
     */
    public function tryUpdate($id, array $attributes, Model $model, $shouldValidate = true)
    {
        // try to locate record based on id
        $record = $model->find($id);

        // no match. throw exception
        if (!$record) {
            throw new Exception("Attempting to update: {$id}, we were not able to find a match");
        }

        // validator
        $validator = $this->updateValidator($attributes, $model->getRules());

        if ($shouldValidate) {
            $passes = $validator->passes();

            if (!$passes) {
                return [
                    $passes,
                    $validator->messages(),
                    null
                ];
            }
        }

        // update
        $result = $record->update($attributes);

        return [
            $validator->passes(),
            $validator->messages(),
            $result
        ];
    }

    /**
     * Try update or create
     * @param array $attributes
     * @param Model $model
     * @param null $id
     * @return array
     */
    public function tryUpdateOrCreate(array $attributes, Model $model, $id = null)
    {
        // if $id null then we create
        if (is_null($id)) {
            return $this->tryInsert($attributes, $model);
        } else {
            return $this->tryUpdate($id, $attributes, $model);
        }
    }

    /**
     * Update Validator
     *
     * @param array $attributes
     * @param $rules
     * @return \Illuminate\Validation\Validator
     */
    public function updateValidator(array $attributes, $rules)
    {
        // rules
        $updateRules = array_intersect_key($rules, $attributes);

        return Validator::make($attributes, $updateRules);
    }

    /**
     * Try insert
     *
     * @param array $attributes
     * @param Model $model
     * @return array
     */
    public function tryInsert(array $attributes, Model $model, $doFillable = true)
    {
        // validator
        $validator = $this->insertValidator($attributes, $model->getRules());
        $passes = $validator->passes();

        $result = null;
        // default result
        if ($passes) {
            if ($doFillable) {
                $result = $model->create($attributes);
            } else {
                // we can mass assign or we can instantiate model and set the field and save.
                $result = $this->setUpModel($attributes, $model);
            }
        }

        return [
            $passes,
            $validator->messages(),
            $result
        ];
    }

    /**
     * Alternative instead of doing mass assignment. attributes should have the primary key with value in order to save correctly.
     * Otherwise it will save it to primary column set to 0
     *
     * @param array $attributes
     * @param Model $model
     */
    protected function setUpModel(array $attributes, Model $model)
    {
        // loop through the attributes and set them up and save
        foreach($attributes as $key => $value)
        {
            $model->$key = $value;
        }
        // save it
        return $model->save();
    }

    /**
     * Insert validator
     *
     * @param array $attributes
     * @param $rules
     * @return \Illuminate\Validation\Validator
     */
    public function insertValidator(array $attributes, $rules)
    {
        return Validator::make($attributes, $rules);
    }

    /**
     * try delete
     * @param array $ids
     * @param Model $model
     * @return array
     */
    public function tryDelete(array $ids, Model $model)
    {
        $validator = $this->deleteValidator($ids);
        $passes = $validator->passes();

        // result
        $result = null;

        if ($passes) {
            // delete. using passed in model
            $result = $model->destroy($ids);
        }

        return [
            $passes,
            $validator->messages(),
            $result
        ];
    }

    public function deleteValidator(array $ids)
    {
        // default empty validator
        return Validator::make([], []);
    }

    /**
     * Mass Update
     *
     * @param $builder QueryBuilder
     * @param array $attributes
     * @param bool $shouldValidate
     * @return array
     */
    public function tryMassUpdate($builder, array $attributes, $shouldValidate =  true)
    {
        // pull model to get rules
        $model = $builder->getModel();

        // validate
        $validator = $this->updateValidator($attributes, $model->getRules());

        // are we trying to validate?
        if ($shouldValidate) {
            // if not valid. return
            if (!$validator->passes()) {
                return [
                    $validator->passes(),
                    $validator->messages(),
                    null
                ];
            }
        }

        // update
        $result = $builder->update($attributes);

        return [
            $validator->passes(),
            $validator->messages(),
            $result
        ];
    }

    /**
     * Insert to relationship model
     *
     * @param $builder relationship builder
     * @param array $attributes
     * @return array
     */
    public function tryInsertToRelationship($builder, array $attributes)
    {
        $model = $builder->getModel();

        // validate all insert calls
        $validator = $this->insertValidator($attributes, $model->getRules());
        $passes = $validator->passes();

        $result = null;
        if ($passes) {
            $result = $builder->create($attributes);
        }

        return [
            true,
            $validator->messages(),
            $result
        ];
    }

    /**
     * TryDelete using builder
     *
     * @param $builder QueryBuilder
     * @param Model $model
     * @return array
     */
    public function tryDeleteWithBuilder($builder, Model $model)
    {
        $validator = $this->deleteValidator([]);
        $passes = $validator->passes();

        // result
        $result = null;

        if ($passes) {
            // delete. using passed in model
            $result = $builder->delete();
        }

        return [
            $passes,
            $validator->messages(),
            $result
        ];
    }
}