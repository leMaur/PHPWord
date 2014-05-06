<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2014 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\RTF\Element;

use PhpOffice\PhpWord\Element\Text as TextElement;

/**
 * TextRun element RTF writer
 *
 * @since 0.10.0
 */
class TextRun extends Element
{
    /**
     * Write element
     *
     * @return string
     */
    public function write()
    {
        if (!$this->element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            return;
        }

        $rtfText = '';

        $elements = $this->element->getElements();
        if (count($elements) > 0) {
            $rtfText .= '\pard\nowidctlpar' . PHP_EOL;
            foreach ($elements as $element) {
                if ($element instanceof TextElement) {
                    $elementWriter = new Element($this->parentWriter, $element, true);
                    $rtfText .= '{';
                    $rtfText .= $elementWriter->write();
                    $rtfText .= '}' . PHP_EOL;
                }
            }
            $rtfText .= '\par' . PHP_EOL;
        }

        return $rtfText;
    }
}
