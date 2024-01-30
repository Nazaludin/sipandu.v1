<?php

namespace App\Libraries;

use Throwable;
use Loncat\Moody\Config;
// use Llagerlof\moodlerest\MoodleRest;

require_once VENDORPATH . '/llagerlof/moodlerest/MoodleRest.php';
// require_once COMPOSER_PATH;


class UserLibrary
{
    private $rest;

    public function __construct(Config $config)
    {
        $this->rest = new \MoodleRest($config->getMoodleBaseUrl(), $config->getMoodleToken(), \MoodleRest::RETURN_ARRAY);
    }

    public function getUserIdByEmail($email)
    {
        try {
            $result = $this->rest->request(
                "core_user_get_users_by_field",
                ["field" => 'email', "values" => [$email]]
            );

            if (is_array($result) && sizeof($result) > 0) {
                if (array_key_exists("errorcode", $result)) {
                    return [
                        "data" => [],
                        "error" => [
                            "code" => 500,
                            "message" => $result["message"]
                        ]
                    ];
                } else {
                    $data = $result[0];
                    return [
                        "data" => [
                            "userid" => strval($data["id"]),
                        ],
                        "error" => []
                    ];
                }
            } else {
                return [
                    "data" => [],
                    "error" => [
                        "code" => 404,
                        "message" => "Not Found"
                    ]
                ];
            }
        } catch (Throwable $error) {
            return [
                "data" => [],
                "error" => [
                    "code" => 400,
                    "message" => $error->getMessage()
                ]
            ];
        }
    }
}
