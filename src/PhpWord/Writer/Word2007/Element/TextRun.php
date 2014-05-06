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

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

use PhpOffice\PhpWord\Writer\Word2007\Style\Paragraph as ParagraphStyleWriter;

/**
 * TextRun element writer
 *
 * @since 0.10.0
 */
class TextRun extends Element
{
    /**
     * Write textrun element
     */
    public function write()
    {
        if (!$this->element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            return;
        }

        $paragraphStyle = $this->element->getParagraphStyle();
        $styleWriter = new ParagraphStyleWriter($this->xmlWriter, $paragraphStyle);
        $styleWriter->setIsInline(true);

        $this->xmlWriter->startElement('w:p');
        $styleWriter->write();
        $this->parentWriter->writeContainerElements($this->xmlWriter, $this->element);
        $this->xmlWriter->endElement(); // w:p
    }
}
