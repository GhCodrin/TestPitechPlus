<?php

$response = [];
$action = $_POST['action'];
switch ($action) {
    case 'getRandomCoordonates': {
            if (array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {
                $response = [
                    'x' => rand(0, $_POST['width']),
                    'y' => rand(0, $_POST['height']),
                ];
            }
            break;
        }
    case 'validateInput': {
            if (array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {
                $height = $_POST['height'];
                $width = $_POST['width'];
                if ($height <= 0 || $width <= 0 || $height > 1000 || $width > 1000) {
                    $response['isValid'] = false;
                } else {
                    $response['isValid'] = true;
                }
            }
            break;
        }
    case 'moveUp': {
            if (array_key_exists('x', $_POST) && array_key_exists('y', $_POST) && array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {

                $x = $_POST['x'];
                $y = $_POST['y'] - 1;
                if (checkPosition($_POST['width'], $_POST['height'], $x, $y)) {
                    $response = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }

            break;
        }
    case 'moveDown': {
            if (array_key_exists('x', $_POST) && array_key_exists('y', $_POST) && array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {
                $x = $_POST['x'];
                $y = $_POST['y'] + 1;
                if (checkPosition($_POST['width'], $_POST['height'], $x, $y)) {
                    $response = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }

            break;
        }
    case 'moveRight': {
            if (array_key_exists('x', $_POST) && array_key_exists('y', $_POST) && array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {
                $x = $_POST['x'] + 1;
                $y = $_POST['y'];
                if (checkPosition($_POST['width'], $_POST['height'], $x, $y)) {
                    $response = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }

            break;
        }
    case 'moveLeft': {
            if (array_key_exists('x', $_POST) && array_key_exists('y', $_POST) && array_key_exists('width', $_POST) && array_key_exists('height', $_POST)) {
                $x = $_POST['x'] - 1;
                $y = $_POST['y'];
                if (checkPosition($_POST['width'], $_POST['height'], $x, $y)) {
                    $response = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }
            }

            break;
        }
}
//var_dump($_POST);

function checkPosition(int $width, int $height, int $x, int $y)
{
    if ($x < 0 || $y < 0 || $x > $width || $y > $height) {
        return false;
    }
    return true;
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
