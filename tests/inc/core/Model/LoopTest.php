<?php

namespace Runalyze\Model;

class Loopable_MockTester extends Object implements Loopable {
	public function __construct() {
		parent::__construct(array(
			'foo' => array(1, 2, 3, 4,  5),
			'bar' => array(2, 4, 6, 8, 10)
		));
	}
	public function num() {
		return 5;
	}
	public function isArray($key) {
		return true;
	}
	public function properties() {
		return array('foo', 'bar');
	}
	public function at($index, $key) {
		return $this->Data[$key][$index];
	}
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-11-11 at 09:57:04.
 */
class LoopTest extends \PHPUnit_Framework_TestCase {

	protected function exampleLoop() {
		return new Loop(new Loopable_MockTester());
	}

	public function testSimpleLoop() {
		$Loop = $this->exampleLoop();

		$Loop->nextStep();
		$this->assertEquals(2, $Loop->current('foo'));
		$this->assertEquals(4, $Loop->current('bar'));

		$Loop->setStepSize(2);
		$Loop->nextStep();
		$this->assertEquals(4, $Loop->current('foo'));
		$this->assertEquals(8, $Loop->current('bar'));
		$this->assertEquals(array(3,4), $Loop->slice('foo'));
		$this->assertEquals(array(6,8), $Loop->slice('bar'));
		$this->assertEquals(3+4, $Loop->sum('foo'));
		$this->assertEquals(8, $Loop->max('bar'));
		$this->assertEquals(8-4, $Loop->difference('bar'));
		$this->assertEquals((6+8)/2, $Loop->average('bar'));

		$Loop->nextStep();
		$this->assertTrue($Loop->isAtEnd());

		$Loop->reset();
		$this->assertFalse($Loop->isAtEnd());
		$this->assertEquals(1, $Loop->current('foo'));
		$this->assertEquals(2, $Loop->current('bar'));
	}

}
