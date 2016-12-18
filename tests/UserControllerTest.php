<?php

/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 16/12/16
 * Time: 19:04
 */
class UserControllerTest extends TestCase
{

    public function testCreateUser()
    {
        $this->json('POST', '/user', ['name' => 'Sally'])
            ->seeJson([
                'created' => true,
            ]);
    }

}
