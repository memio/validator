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
use Memio\Model\Constant;
use Memio\Model\Method;
use Memio\Model\Property;
use Memio\Validator\Constraint;
use Memio\Validator\ConstraintValidator;
use Memio\Validator\ModelValidator;
use Memio\Validator\ViolationCollection;

class CollectionValidator implements ModelValidator
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

    public function supports($model): bool
    {
        if (!is_array($model) || empty($model)) {
            return false;
        }
        $firstElement = current($model);

        return
            $firstElement instanceof Argument || $firstElement instanceof Constant
            || $firstElement instanceof Method || $firstElement instanceof Property
        ;
    }

    public function validate($model): ViolationCollection
    {
        if (!$this->supports($model)) {
            return new ViolationCollection();
        }

        return $this->constraintValidator->validate($model);
    }
}
