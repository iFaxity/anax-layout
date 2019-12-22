<?php

namespace Faxity\Flash;

use PHPUnit\Framework\TestCase;
use Anax\DI\DI;
use Anax\DI\DIMagic;

/**
 * Test the Flash DI Service.
 */
class FlashTest extends TestCase
{
    /** @var DI $di Dependency injector */
    private $di;
    /** @var Flash $flash */
    private $flash;


    /**
     * Setup for each test case
     *
     * @return void
     */
    public function setUp(): void
    {
        global $di;

        // Create dependency injector with services
        $di = new DIMagic();
        $di->loadServices(__DIR__ . "/config/di");

        $this->di = $di;
        $this->flash = new Flash("faxity/flash/default", "flash");
        $this->flash->setDI($this->di);
    }


    /**
     * Teardown for each test case
     *
     * @return void
     */
    public function tearDown(): void
    {
        global $di;

        $di = null;
        $this->di = null;
        $this->flash = null;
    }


    /**
     * Tests the ok, warn and err methods, for adding messages
     */
    public function testAddMessage() : void
    {
        $this->flash->ok("Success message", true);
        $this->flash->warn("Warning message");
        $this->flash->err("Error message", true);

        // Only ok and err was immediate messages
        $messages = $this->flash->getMessages();
        $this->assertIsArray($messages);
        $this->assertCount(2, $messages);

        // Unpack the 3 messages
        list($ok, $err) = $messages;
        $this->assertEquals($ok->type, "ok");
        $this->assertEquals($ok->text, "Success message");
        $this->assertEquals($err->type, "err");
        $this->assertEquals($err->text, "Error message");

        // Check if the warn message was deferred
        $deferred = $this->di->session->get("flash");
        $this->assertIsArray($deferred);
        $this->assertCount(1, $deferred);

        // Unpack the message
        list($warn) = $deferred;
        $this->assertEquals($warn->type, "warn");
        $this->assertEquals($warn->text, "Warning message");
    }


    /**
     * Tests the render method
     */
    public function testRender()
    {
        // Check if render adds region to view
        $this->assertFalse($this->di->view->hasContent("flash"));
        $this->flash->render();
        $this->assertTrue($this->di->view->hasContent("flash"));
    }
}
