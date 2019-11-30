<?php

return [
    // Separator
    "delimiter" => "/,/",

    // Terminator for each message. Removed with rtrim
    "terminator" => ";",

    // Prefix for each message. Removed with preg replace
    "prefix" => "##,imei:",

    // Format => string or binary
    "format" => "string",

    "receive_command" => [
        "101" => [
            "type" => "location",
            "description" => "Location data",
        ],
        "tracker" => [
            "type" => "location",
            "description" => "Location data",
        ],
        "dt" => [
            "type" => "response",
            "description" => "Cancel auto track successful",
        ],

        "et" => [
            "type" => "response",
            "description" => "Cancel alarm successful",
        ],

        "gt" => [
            "type" => "response",
            "description" => "Set movement alarm successful",
        ],

        "ht" => [
            "type" => "response",
            "description" => "Set overspeed alarm successful",
        ],

        "it" => [
            "type" => "response",
            "description" => "Set time zone successful",
        ],

        "jt" => [
            "type" => "response",
            "description" => "Cut off oil and power successful",
        ],

        "kt" => [
            "type" => "response",
            "description" => "Resume oil and power successful",
        ],

        "lt" => [
            "type" => "response",
            "description" => "Set arm successful",
        ],

        "mt" => [
            "type" => "response",
            "description" => "Disarm successful",
        ],

        "nt" => [
            "type" => "response",
            "description" => "Switch to SMS mode successful",
        ],

        "ot" => [
            "type" => "response",
            "description" => "Set GEO fence successful",
        ],

        "pt" => [
            "type" => "response",
            "description" => "Cancel geo fence successful",
        ],

        "qt" => [
            "type" => "response",
            "description" => "Start data upload successful",
        ],

        "st" => [
            "type" => "response",
            "description" => "Stop data upload successful",
        ],

        "tt" => [
            "type" => "response",
            "description" => "Set less GPRS successful",
        ],

        "vt" => [
            "type" => "response",
            "description" => "Take photo request successful",
        ],

        "help me" => [
            "type" => "alarm",
            "description" => "SOS alarm",
        ],

        "low battery" => [
            "type" => "alarm",
            "description" => "Low battery alarm",
        ],

        "move" => [
            "type" => "alarm",
            "description" => "Movement alarm",
        ],

        "speed" => [
            "type" => "alarm",
            "description" => "Overspeed alarm",
        ],

        "stockade" => [
            "type" => "alarm",
            "description" => "GEO fence has been breached",
        ],

        "ac alarm" => [
            "type" => "alarm",
            "description" => "Vehicle was powered off",
        ],

        "door alarm" => [
            "type" => "alarm",
            "description" => "Vehicle door is open",
        ],

        "sensor alarm" => [
            "type" => "alarm",
            "description" => "Shock alarm",
        ],

        "acc alarm" => [
            "type" => "alarm",
            "description" => "ACC alarm",
        ],

        "acc off" => [
            "type" => "alarm",
            "description" => "ACC off alarm",
        ],

        "acc on" => [
            "type" => "alarm",
            "description" => "ACC on alarm",
        ],

        "accident alarm" => [
            "type" => "alarm",
            "description" => "Accident may have occured",
        ],

        "bonnet alarm" => [
            "type" => "alarm",
            "description" => "Bonnet alarm",
        ],

        "footbreak alarm" => [
            "type" => "alarm",
            "description" => "Footbreak alarm",
        ],

        "T:" => [
            "type" => "alarm",
            "description" => "High temperature alarm",
        ],

        "oil" => [
            "type" => "alarm",
            "description" => "Low fuel alarm",
        ],

        "DTC" => [
            "type" => "alarm",
            "description" => "Diagnostic problem in terminal",
        ],

        "service" => [
            "type" => "alarm",
            "description" => "Vehicle maintenance notification",
        ]
    ],

    "send_command" => [
        // Separator
        "delimiter" => ",",

        // Terminator for each message. Removed with rtrim
        "terminator" => ";",

        // Prefix for each message. Removed with preg replace
        "prefix" => "**,imei:",

        "enable_tracking" => "**,imei:%s,C,10s",

        "disable_tracking" => "**,imei:%s,D",

        "stop_engine" => "**,imei:%s,J",

        "start_engine" => "**,imei:%s,K",

    ]
];
