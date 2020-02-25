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
use Memio\Model\File;
use Memio\Model\Objekt;
use Memio\Validator\Constraint;
use Memio\Validator\ConstraintValidator;
use Memio\Validator\ModelValidator;
use Memio\Validator\ViolationCollection;

class FileValidator implements ModelValidator
{
    private $contractValidator;
    private $objectValidator;

    public function __construct(
        ContractValidator $contractValidator,
        ObjectValidator $objectValidator
    ) {
        $this->contractValidator = $contractValidator;
        $this->objectValidator = $objectValidator;

        $this->constraintValidator = new ConstraintValidator();
    }

    public function add(Constraint $constraint): void
    {
        $this->constraintValidator->add($constraint);
    }

    public function supports($model): bool
    {
        return $model instanceof File;
    }

    public function validate($model): ViolationCollection
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }
        $violationCollection = $this->constraintValidator->validate($model);
        $structure = $model->structure;
        if ($structure instanceof Contract) {
            $violationCollection->merge($this->contractValidator->validate($structure));
        }
        if ($structure instanceof Objekt) {
            $violationCollection->merge($this->objectValidator->validate($structure));
        }

        return $violationCollection;
    }
}
