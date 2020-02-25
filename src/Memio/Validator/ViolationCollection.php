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
use Memio\Validator\Violation\SomeViolation;

class ViolationCollection
{
    private $violations = [];

    public function add(Violation $violation): void
    {
        if ($violation instanceof SomeViolation) {
            $this->violations[] = $violation->getMessage();
        }
    }

    public function merge(ViolationCollection $violationCollection): void
    {
        $this->violations = array_merge(
            $this->violations,
            $violationCollection->violations
        );
    }

    /**
     * @throws InvalidModelException If model is invalid
     */
    public function raise()
    {
        if (!empty($this->violations)) {
            throw new InvalidModelException($this->violations);
        }
    }
}
