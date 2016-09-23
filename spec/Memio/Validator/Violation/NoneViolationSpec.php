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

class NoneViolationSpec extends ObjectBehavior
{
    function it_is_a_violation()
    {
        $this->shouldHaveType(Violation::class);
    }

    function it_never_has_a_message()
    {
        $this->getMessage()->shouldBe('');
    }
}
