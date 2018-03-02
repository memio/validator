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

use Memio\Model\Contract;
use Memio\Validator\Constraint;
use Memio\Validator\ConstraintValidator;
use Memio\Validator\ModelValidator;
use Memio\Validator\ViolationCollection;

class ContractValidator implements ModelValidator
{
    private $collectionValidator;
    private $constraintValidator;
    private $methodValidator;

    public function __construct(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator
    ) {
        $this->collectionValidator = $collectionValidator;
        $this->methodValidator = $methodValidator;

        $this->constraintValidator = new ConstraintValidator();
    }

    public function add(Constraint $constraint)
    {
        $this->constraintValidator->add($constraint);
    }

    public function supports($model): bool
    {
        return $model instanceof Contract;
    }

    public function validate($model): ViolationCollection
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $violationCollection->merge($this->collectionValidator->validate($model->allConstants()));
        $violationCollection->merge($this->collectionValidator->validate($model->allContracts()));
        $methods = $model->allMethods();
        $violationCollection->merge($this->collectionValidator->validate($methods));
        foreach ($methods as $method) {
            $violationCollection->merge($this->methodValidator->validate($method));
        }

        return $violationCollection;
    }
}
