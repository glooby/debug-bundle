<?php

namespace Glooby\Debug\Formatter;

/**
 * @author Emil Kilhage
 */
class FormatterHelper
{
    /**
     * @param array $sections
     * @return string
     */
    public static function formatSections(array $sections)
    {
        $sectionsFormatted = [];

        foreach ($sections as $k => $v) {
            $sectionsFormatted[] = sprintf("%s\n%s\n%s", $k, str_repeat('-', strlen($k)), trim($v));
        }

        $text = implode("\n\n", $sectionsFormatted) . "\n";

        return $text;
    }
}
