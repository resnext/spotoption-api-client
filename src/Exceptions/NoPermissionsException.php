<?php

namespace SpotOption\Exceptions;

use SpotOption\ServerException;

/**
 * This exception raised when you do not have permission to perform the query requested, or you have mis-typed the name
 * of the module or command.
 *
 * For solve this problem you have to request permission for the Module->command that you are trying to perform.
 *
 * Class NoPermissionsException
 * @package SpotOption\Exceptions
 */
class NoPermissionsException extends ServerException
{

}