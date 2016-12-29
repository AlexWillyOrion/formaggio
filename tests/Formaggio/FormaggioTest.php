<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 29/12/16
 * Time: 11.27
 */

namespace Formaggio;


class FormaggioTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $this->expectOutputString('<form action="/" method="post"><input type="text" name="test"></form>' . PHP_EOL);

        $formaggio = new Formaggio();
        $formaggio->text("test");
        $formaggio->render();
    }

    public function testGet()
    {
        $formaggio = new Formaggio();
        $formaggio->text("test");
        $result = $formaggio->get();

        $this->assertEquals('<form action="/" method="post"><input type="text" name="test"></form>', $result);
    }

    /**
     * @dataProvider textProvider
     */
    public function testText($inputs, $expected)
    {
        $formaggio = new Formaggio();
        $formaggio->text($inputs['name'], $inputs['attributes']);
        $result = $formaggio->getField();
        $this->assertEquals($expected, $result);
    }

    public function textProvider()
    {
        return [
            [
                [
                    "name" => "testname",
                    "attributes" => [
                        "placeholder" => "testplace",
                    ],
                ],
                [
                    "name" => "testname",
                    "placeholder" => "testplace",
                    "type" => "text",
                ],
            ],
            [
                [
                    "name" => "",
                    "attributes" => [],
                ],
                [
                    "name" => "",
                    "type" => "text",
                ],
            ],
        ];
    }

    /**
     * @dataProvider emailProvider
     */
    public function testEmail($inputs, $expected)
    {
        $formaggio = new Formaggio();
        $formaggio->email($inputs['name'], $inputs['attributes']);
        $result = $formaggio->getField();
        $this->assertEquals($expected, $result);
    }

    public function emailProvider()
    {
        return [
            [
                [
                    "name" => "testname",
                    "attributes" => [
                        "placeholder" => "testplace",
                    ],
                ],
                [
                    "name" => "testname",
                    "placeholder" => "testplace",
                    "type" => "email",
                ],
            ],
            [
                [
                    "name" => "",
                    "attributes" => [],
                ],
                [
                    "name" => "",
                    "type" => "email",
                ],
            ],
        ];
    }

    /**
     * @dataProvider passwordProvider
     */
    public function testPassword($inputs, $expected)
    {
        $formaggio = new Formaggio();
        $formaggio->password($inputs['name'], $inputs['attributes']);
        $result = $formaggio->getField();
        $this->assertEquals($expected, $result);
    }

    public function passwordProvider()
    {
        return [
            [
                [
                    "name" => "testname",
                    "attributes" => [
                        "placeholder" => "testplace",
                    ],
                ],
                [
                    "name" => "testname",
                    "placeholder" => "testplace",
                    "type" => "password",
                ],
            ],
            [
                [
                    "name" => "",
                    "attributes" => [],
                ],
                [
                    "name" => "",
                    "type" => "password",
                ],
            ],
        ];
    }

    public function testPlace()
    {
        $formaggio = new Formaggio();
        $formaggio->text()->place("placeholder here");
        $result = $formaggio->getField();
        $this->assertEquals("placeholder here", $result['placeholder']);
    }
}
