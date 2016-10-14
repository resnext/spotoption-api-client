<?php

namespace SpotOption\Exceptions;

use SpotOption\ServerException;

/**
 * This exception will be thrown when request sent from server which have IP address that not added to SpotOption IP
 * white list. In this case you should:
 *
 * 1. Check IP protocol (IPv4 or IPv6) that used.
 * 2. Make sure that used external IP address added to white-list.
 *
 * Some misunderstanding may be exists when brand have added you external IPv4 address but your server used IPv6.
 * Some brands have not AAAA records for their domain which contains SpotOption platform and some brands have AAAA recs.
 *
 * Class NotWhitelistedIpException
 * @package SpotOption\Exceptions
 */
class NotWhitelistedIpException extends ServerException
{

}