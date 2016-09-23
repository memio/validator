<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Validator\Violation;

use Memio\Validator\Violation;
use PhpSpec\ObjectBehavior;

class SomeViolationSpec extends ObjectBehavior
{
    const MESSAGE = 'Model is invalid';

    function let()
    {
        $this->beConstructedWith(self::MESSAGE);
    }

    function it_is_a_violation()
    {
        $this->shouldHaveType(Violation::class);
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }
}
