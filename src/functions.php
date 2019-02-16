<?php
namespace TextColorCalculator;

function fromColorCode($bgRed, $bgGreen, $bgBlue) {
    $luminance = (0.299 * $bgRed + 0.587 * $bgGreen + 0.114 * $bgBlue) / 255;

    if ($luminance > 0.5) {
        return [0, 0, 0]; // Black
    }

    return [255, 255, 255];
}

function fromHtmlCode($htmlCode) {
    if (!is_string($htmlCode)) {
        throw new \Exception('Exepected HTML code to be string');
    }
    $len = \strlen($htmlCode);
    if (\in_array($len, [4, 7])) {
        if (strpos($htmlCode, '#') !== 0) {
            throw new \Exception('Invalid HTML code');
        }

        $htmlCode = substr($htmlCode, 1);
    } else if (!\in_array($len, [3, 6])) {
        throw new \Exception('Invalid HTML code');
    }

    $red = $green = $blue = '';
    $colorLen = intval(\strlen($htmlCode) / 3);
    foreach (str_split($htmlCode) as $index => $char) {
        $char = strtoupper($char);
        if (
            $char < '0' && $char > '9' &&
            $char < 'A' && $char > 'F'
        ) {
            throw new \Exception('Invalid HTML code');
        }

        $colorCode = $colorLen === 1 ? $char . $char : $char;

        if ($index < $colorLen) {
            $red .= $colorCode;
        } else if ($index < (2 * $colorLen)) {
            $green .= $colorCode;
        } else {
            $blue .= $colorCode;
        }
    }

    return fromColorCode(hexdec($red), hexdec($green), hexdec($blue));
}

function toHtmlCode($colorTuple) {
    list($red, $green, $blue) = $colorTuple;

    return '#' . dechex($red) . dechex($green) . dechex($blue);
}
