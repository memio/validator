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

use Memio\Model\Method;
use Memio\Model\Objekt;
use Memio\Validator\ModelValidator;
use Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Validator\ModelValidator\MethodValidator;
use Memio\Validator\ViolationCollection;
use PhpSpec\ObjectBehavior;

class ObjectValidatorSpec extends ObjectBehavior
{
    function let(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator
    ) {
        $this->beConstructedWith($collectionValidator, $methodValidator);
    }

    function it_is_a_model_validator()
    {
        $this->shouldImplement(ModelValidator::class);
    }

    function it_supports_objects(Objekt $model)
    {
        $this->supports($model)->shouldBe(true);
    }

    function it_also_validates_methods(
        CollectionValidator $collectionValidator,
        MethodValidator $methodValidator,
        Objekt $model,
        Method $method
    ) {
        $constants = [];
        $contracts = [];
        $methods = [$method];
        $properties = [];
        $violationCollection1 = new ViolationCollection();
        $violationCollection2 = new ViolationCollection();
        $violationCollection3 = new ViolationCollection();
        $violationCollection4 = new ViolationCollection();
        $violationCollection5 = new ViolationCollection();

        $model->getName()->willReturn('Symfony\Component\HttpKernel\HttpKernelInterface');
        $collectionValidator->validate($constants)->willReturn($violationCollection1);
        $collectionValidator->validate($contracts)->willReturn($violationCollection2);
        $collectionValidator->validate($properties)->willReturn($violationCollection3);
        $collectionValidator->validate($methods)->willReturn($violationCollection4);
        $methodValidator->validate($method)->willReturn($violationCollection5);

        $this->validate($model);
    }
}
