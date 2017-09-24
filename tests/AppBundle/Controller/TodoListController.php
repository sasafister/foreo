<?php
/**
 * Created by PhpStorm.
 * User: sasa
 * Date: 19/09/2017
 * Time: 11:06
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListController extends WebTestCase
{

    public function testShowTodos() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(
            10,
            $crawler->filter('li')->count()
        );
    }

    public function testShowTodo() {

        $client = static::createClient();

        $client->request('GET', '/todo/5/edit');

        $this->assertContains(
            'Task5',
            $client->getResponse()->getContent()
        );

    }

    public function testUpdateTodo() {

        $client = static::createClient();

        $crawler = $client->request('GET', '/todo/1/edit');

        $this->assertContains(
            'Task1',
            $client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Update')->form();

        $form['todo_list_form[name]'] = 'TaskTest';
        $client->submit($form);

        $client->followRedirect();

        $this->assertContains(
            'TaskTest',
            $client->getResponse()->getContent()
        );

    }


    public function testDeleteTodo() {
        $client = static::createClient();

        $client->request('GET', '/todo/10/remove');
        $count = $client->request('GET', '/');
        $this->assertEquals(
            9,
            $count->filter('li')->count()
        );
    }


}