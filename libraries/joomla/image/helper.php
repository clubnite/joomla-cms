<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Mail
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Image helper class, provides static methods to perform various tasks relevant
 * to the Joomla image routines.
 *
 * @package     Joomla.Platform
 * @subpackage  Mail
 * @since       13.1
 */
abstract class JMailHelper
{
	/**
	 * Method to return a properties object for an image given a filesystem path.  The
	 * result object has values for image width, height, type, attributes, mime type, bits,
	 * and channels.
	 *
	 * @static
	 * @param   string  $path  The filesystem path to the image for which to get properties.
	 *
	 * @return  stdClass
	 *
	 * @since   11.3
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 */
	public static function getImageFileProperties($path)
	{
		// Make sure the file exists.
		if (!file_exists($path))
		{
			throw new InvalidArgumentException('The image file does not exist.');
		}

		// Get the image file information.
		$info = getimagesize($path);

		if (!$info)
		{
			// @codeCoverageIgnoreStart
			throw new RuntimeException('Unable to get properties for the image.');

			// @codeCoverageIgnoreEnd
		}

		// Build the response object.
		$properties = (object) array(
			'width' => $info[0],
			'height' => $info[1],
			'type' => $info[2],
			'attributes' => $info[3],
			'bits' => isset($info['bits']) ? $info['bits'] : null,
			'channels' => isset($info['channels']) ? $info['channels'] : null,
			'mime' => $info['mime']
		);

		return $properties;
	}
}
