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

class ConstraintValidator
{
    private $constraints = [];

    public function add(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }

    public function validate($model) : ViolationCollection
    {
        $violationCollection = new ViolationCollection();
        foreach ($this->constraints as $constraint) {
            $violationCollection->add($constraint->validate($model));
        }

        return $violationCollection;
    }
}
