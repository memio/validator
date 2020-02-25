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

interface ModelValidator
{
    public function add(Constraint $constraint): void;

    public function supports($model): bool;

    public function validate($model): ViolationCollection;
}
