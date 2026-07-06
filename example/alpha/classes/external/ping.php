<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace dummyexample_alpha\external;

use context_system;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;

/**
 * Dummy alpha subplugin ping external function.
 *
 * @package    dummyexample_alpha
 * @copyright  2026 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class ping extends external_api {

    /**
     * Describes the parameters for this function.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'message' => new external_value(PARAM_TEXT, 'Message to echo back.', VALUE_DEFAULT, 'alpha pong'),
        ]);
    }

    /**
     * Returns a dummy response.
     *
     * @param string $message Message to echo back.
     * @return array
     */
    public static function execute(string $message = 'alpha pong'): array {
        $params = self::validate_parameters(self::execute_parameters(), [
            'message' => $message,
        ]);

        self::validate_context(context_system::instance());

        return [
            'status' => true,
            'message' => $params['message'],
            'component' => 'dummyexample_alpha',
        ];
    }

    /**
     * Describes the return value for this function.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'status' => new external_value(PARAM_BOOL, 'Whether the dummy request succeeded.'),
            'message' => new external_value(PARAM_TEXT, 'Echoed message.'),
            'component' => new external_value(PARAM_COMPONENT, 'Responding component.'),
        ]);
    }
}
