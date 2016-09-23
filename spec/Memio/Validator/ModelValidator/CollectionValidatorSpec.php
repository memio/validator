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

use Memio\Model\Argument;
use Memio\Model\Constant;
use Memio\Model\Method;
use Memio\Model\Property;
use Memio\Validator\ModelValidator;
use PhpSpec\ObjectBehavior;

class CollectionValidatorSpec extends ObjectBehavior
{
    function it_is_a_model_validator()
    {
        $this->shouldImplement(ModelValidator::class);
    }

    function it_supports_argument_collections(Argument $model)
    {
        $this->supports([$model])->shouldBe(true);
    }

    function it_supports_constant_collections(Constant $model)
    {
        $this->supports([$model])->shouldBe(true);
    }

    function it_supports_method_collections(Method $model)
    {
        $this->supports([$model])->shouldBe(true);
    }

    function it_supports_property_collections(Property $model)
    {
        $this->supports([$model])->shouldBe(true);
    }

    function it_does_not_support_empty_collections()
    {
        $this->supports([])->shouldBe(false);
    }
}
