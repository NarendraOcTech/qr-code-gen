<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\BodyParsingMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Label;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$qrDir = __DIR__ . "/qrcodes";
if (!is_dir($qrDir)) {
    mkdir($qrDir, 0755, true);
}

$app->post('/generate-qr', function (ServerRequestInterface $request, ResponseInterface $response) use ($qrDir) {
    $body = $request->getParsedBody();
    $ids = $body['ids'] ?? [];

    if (!is_array($ids)) {
        $response->getBody()->write(json_encode([
            'error' => 'Invalid input: expected JSON with \"ids\" array.',
        ]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $qrResults = [];

    foreach ($ids as $id) {
        // Create QR code with label at the bottom
        $url = "https://thedigitalapps.com/milkybar/api/users?id=" . urlencode((string) $id);
        $qrCode = QrCode::create((string) $url)
            ->setSize(300)
            ->setMargin(10);

        $label = Label::create((string) $id);

        $writer = new PngWriter();
        $result = $writer->write($qrCode, null, $label);

        // Save QR with label below
        $filename = "$qrDir/qr_$id.png";
        $result->saveToFile($filename);

        $qrResults[] = [
            'id' => $id,
            'qr_url' => "http://your-domain.com/qrcodes/qr_$id.png", // update your domain here
        ];
    }

    $response->getBody()->write(json_encode([
        'status' => 'success',
        'qrcodes' => $qrResults,
    ]));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
