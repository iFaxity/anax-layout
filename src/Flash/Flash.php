<?php

namespace Faxity\Flash;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * DI module for creating and rendering flash messages
 * All messages are deferred to the next request by default
 */
class Flash implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /** @var array $messages Messages buffer for this request */
    private $messages = [];
    /** @var string $template Anax view template */
    private $template;
    /** @var string $region Anax page region */
    private $region;


    /**
     * Adds flash message to buffer of next request
     * @param string $type      Message type (ok, error or warning)
     * @param string $text      Message text, not required
     * @param bool   $immediate Adds message to this request buffer
     *
     * @return $this
     */
    private function message(string $type, string $text, bool $immediate = false): Flash
    {
        $message = (object)[
            "type" => $type,
            "text" => $text,
        ];

        if ($immediate) {
            $this->messages[] = $message;
        } else {
            $messages = $this->di->session->get("flash", []);
            $messages[] = $message;

            $this->di->session->set("flash", $messages);
        }

        return $this;
    }


    /**
     * @param string      $template Template to render messages
     * @param string|null $region   The region to render to, defaults to "flash"
     *
     * @return $this
     */
    public function __construct(string $template, ?string $region = null)
    {
        $this->template = $template;
        $this->region = $region ?? "flash";
    }


    /**
     * Gets all messages within the current request buffer
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }


    /**
     * Renders flash messages in session to Anax views
     *
     * @return $this
     */
    public function render(): Flash
    {
        $this->messages = $this->di->session->getOnce("flash", []);
        $data = [ "messages" => &$this->messages ];

        $this->di->view->add($this->template, $data, $this->region);
        return $this;
    }


    /**
     * Adds an ok message to render
     * @param string $text      Message text
     * @param bool   $immediate Adds message to this request buffer
     *
     * @return $this
     */
    public function ok(string $text, bool $immediate = false): Flash
    {
        return $this->message("ok", $text, $immediate);
    }


    /**
     * Adds a warning message to render
     * @param string $text      Message text
     * @param bool   $immediate Adds message to this request buffer
     *
     * @return $this
     */
    public function warn(string $text, bool $immediate = false): Flash
    {
        return $this->message("warn", $text, $immediate);
    }


    /**
     * Adds an error message to render
     * @param string $text      Message text
     * @param bool   $immediate Adds message to this request buffer
     *
     * @return $this
     */
    public function err(string $text, bool $immediate = false): Flash
    {
        return $this->message("err", $text, $immediate);
    }
}
