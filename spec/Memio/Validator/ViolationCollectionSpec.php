<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Validator;

use Memio\Validator\Exception\InvalidModelException;
use Memio\Validator\ViolationCollection;
use Memio\Validator\Violation\NoneViolation;
use Memio\Validator\Violation\SomeViolation;
use PhpSpec\ObjectBehavior;

class ViolationCollectionSpec extends ObjectBehavior
{
    const FIRST_MESSAGE = 'Model is invalid';
    const SECOND_MESSAGE = 'Model is wrong';

    function it_raises_exception_if_it_has_any_violations(
        SomeViolation $someViolation,
        SomeViolation $someOtherViolation
    ) {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $someOtherViolation->getMessage()->willReturn(self::SECOND_MESSAGE);

        $this->add($someViolation);
        $this->add($someOtherViolation);

        $this->shouldThrow(InvalidModelException::class)->duringRaise();
    }

    function it_does_not_raise_exception_if_it_has_no_violations()
    {
        $this->raise();
    }

    function it_ignores_none_violations(NoneViolation $noneViolation)
    {
        $this->add($noneViolation);

        $this->raise();
    }

    function it_can_be_merged_with_other_collections(
        SomeViolation $someViolation,
        ViolationCollection $violationCollection
    ) {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);

        $this->add($someViolation);
        $this->merge($violationCollection);

        $this->shouldThrow(InvalidModelException::class)->duringRaise();
    }
}
