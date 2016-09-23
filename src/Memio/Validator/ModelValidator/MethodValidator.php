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

use Memio\Model\Method;
use Memio\Validator\{
    Constraint,
    ConstraintValidator,
    ModelValidator,
    ViolationCollection
};

class MethodValidator implements ModelValidator
{
    private $argumentValidator;
    private $collectionValidator;
    private $constraintValidator;

    public function __construct(
        ArgumentValidator $argumentValidator,
        CollectionValidator $collectionValidator
    ) {
        $this->argumentValidator = $argumentValidator;
        $this->collectionValidator = $collectionValidator;

        $this->constraintValidator = new ConstraintValidator();
    }

    public function add(Constraint $constraint)
    {
        $this->constraintValidator->add($constraint);
    }

    public function supports($model) : bool
    {
        return $model instanceof Method;
    }

    public function validate($model) : ViolationCollection
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $arguments = $model->allArguments();
        $violationCollection->merge($this->collectionValidator->validate($arguments));
        foreach ($arguments as $argument) {
            $violationCollection->merge($this->argumentValidator->validate($argument));
        }

        return $violationCollection;
    }
}
