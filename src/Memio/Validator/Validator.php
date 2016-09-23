<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Validator;

use Memio\Validator\Exception\InvalidModelException;

class Validator
{
    private $modelValidators = [];

    public function add(ModelValidator $modelValidator)
    {
        $this->modelValidators[] = $modelValidator;
    }

    /**
     * @throws InvalidModelException If model is invalid
     */
    public function validate($model)
    {
        $violations = new ViolationCollection();
        foreach ($this->modelValidators as $modelValidator) {
            if ($modelValidator->supports($model)) {
                $violations->merge($modelValidator->validate($model));
            }
        }
        $violations->raise();
    }
}
