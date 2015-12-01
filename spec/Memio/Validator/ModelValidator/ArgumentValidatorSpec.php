<?php

/*
 * This file is part of the memio/validator package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Memio\Validator\ModelValidator;

use Memio\Validator\ViolationCollection;
use Memio\Model\Argument;
use PhpSpec\ObjectBehavior;

class ArgumentValidatorSpec extends ObjectBehavior
{
    function it_is_a_model_validator()
    {
        $this->shouldImplement('Memio\Validator\ModelValidator');
    }

    function it_supports_arguments(Argument $model)
    {
        $this->supports($model)->shouldBe(true);
    }
}
