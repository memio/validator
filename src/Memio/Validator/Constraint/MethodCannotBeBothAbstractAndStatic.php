<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Validator\Constraint;

use Memio\Validator\Constraint;
use Memio\Validator\Violation\NoneViolation;
use Memio\Validator\Violation\SomeViolation;

class MethodCannotBeBothAbstractAndStatic implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        if ($model->isAbstract() && $model->isStatic()) {
            return new SomeViolation(sprintf('Method "%s" cannot be both abstract and static', $model->getName()));
        }

        return new NoneViolation();
    }
}
