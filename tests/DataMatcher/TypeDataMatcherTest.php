<?php

namespace Drupal\Tests\rules\Unit\DataMatcher;

use FOD\Instruct\DataMatcher\TypeDataMatcher;

use PHPUnit_Framework_TestCase as TestCase;

class StringTypeDataMatcherTest extends TestCase
{

    /**
     * The condition to be tested.
     *
     * @var \FOD\Instruct\DataMatcher\DataMatcherInterface
     */
    protected $matcher;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->matcher = TypeDataMatcher::create();
    }

    /**
     * @dataProvider matchesProvider
     */
    public function testMatch($expectedMatchResult, $subject, $object)
    {
        $this->assertSame($expectedMatchResult, $this->matcher->match($subject, $object));
    }

    public function matchesProvider()
    {
        return [
          // integer subject
          [true, 1, 'integer'],
          [false, 1, 'string'],

          // string subject
          [true, '1', 'string'],
          [false, '1', 'integer'],

          // boolean subject
          [true, false, 'boolean'],
          [false, true, 'integer'],

          // array subject
          [true, [], 'array'],
          [false, ['foo'], 'integer'],

          // null subject
          [true, null, 'NULL'],
          [false, null, 'integer'],

          // class subject
          [true, new \SplQueue(), '\SplQueue'],
          [false, new \SplQueue(), '\SplStack'],
        ];
    }
}
