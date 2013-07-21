<?php
namespace UpCloo\Renderer;

class Json
{
    public function render($event)
    {
        $dataPack = $event->getParam("dataPack");
        $response = $event->getParam("response");

        $response->getHeaders()->addHeaders(
            array(
                'Content-Type' => 'application/json'
            )
        );
        $response->setContent(json_encode($dataPack));
    }
}