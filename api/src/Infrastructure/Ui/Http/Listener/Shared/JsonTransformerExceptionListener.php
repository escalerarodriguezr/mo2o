<?php
declare(strict_types=1);

namespace Mo2o\Infrastructure\Ui\Http\Listener\Shared;

use Mo2o\Domain\Beer\Exception\BeerNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class JsonTransformerExceptionListener
{

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();


        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        $data = [
            'class' => \get_class($exception),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $exception->getMessage(),
        ];

        if (\in_array($data['class'], $this->getNotFoundExceptions(), true)) {
            $data['code'] = Response::HTTP_NOT_FOUND;
        }


        if ($exception instanceof HttpExceptionInterface) {
            $data['code'] = $exception->getStatusCode();
        }


        $event->setResponse($this->prepareResponse($data));

    }

    private function prepareResponse(array $data): JsonResponse
    {
        $response = new JsonResponse($data, $data['code']);
        $response->headers->set('X-Error-Code', (string) $data['code']);
        $response->headers->set('X-Server-Time', (string) \time());

        return $response;
    }

    private function getNotFoundExceptions(): array
    {
        return [
            BeerNotFoundException::class
        ];
    }

}