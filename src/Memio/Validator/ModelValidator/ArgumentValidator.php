<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Validator\ModelValidator;

use Memio\Model\Argument;
use Memio\Validator\{
    Constraint,
    ConstraintValidator,
    ModelValidator,
    ViolationCollection
};

class ArgumentValidator implements ModelValidator
{
    private $constraintValidator;

    public function __construct()
    {
        $this->constraintValidator = new ConstraintValidator();
    }

    public function add(Constraint $constraint)
    {
        $this->constraintValidator->add($constraint);
    }

    public function supports($model) : bool
    {
        return $model instanceof Argument;
    }

    public function validate($model) : ViolationCollection
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }

        return $this->constraintValidator->validate($model);
    }
}
