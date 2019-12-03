<?php

return [

    "receive_command" => [
        "101" => [
            "job" => \App\Jobs\UpdateTrackerLocation::class,
            "description" => "Location data",
        ],
        "tracker" => [
            "job" => \App\Jobs\UpdateTrackerLocation::class,
            "description" => "Location data",
        ],
        "dt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Cancel auto track successful",
        ],

        "et" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Cancel alarm successful",
        ],

        "gt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set movement alarm successful",
        ],

        "ht" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set overspeed alarm successful",
        ],

        "it" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set time zone successful",
        ],

        "jt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Cut off oil and power successful",
        ],

        "kt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Resume oil and power successful",
        ],

        "lt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set arm successful",
        ],

        "mt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Disarm successful",
        ],

        "nt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Switch to SMS mode successful",
        ],

        "ot" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set GEO fence successful",
        ],

        "pt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Cancel geo fence successful",
        ],

        "qt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Start data upload successful",
        ],

        "st" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Stop data upload successful",
        ],

        "tt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Set less GPRS successful",
        ],

        "vt" => [
            "job" => \App\Jobs\LogTrackerMessage::class,
            "description" => "Take photo request successful",
        ],

        "help me" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "SOS alarm",
        ],

        "low battery" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Low battery alarm",
        ],

        "move" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Movement alarm",
        ],

        "speed" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Overspeed alarm",
        ],

        "stockade" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "GEO fence has been breached",
        ],

        "ac alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Vehicle was powered off",
        ],

        "door alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Vehicle door is open",
        ],

        "sensor alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Shock alarm",
        ],

        "acc alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "ACC alarm",
        ],

        "acc off" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "ACC off alarm",
        ],

        "acc on" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "ACC on alarm",
        ],

        "accident alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Accident may have occured",
        ],

        "bonnet alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Bonnet alarm",
        ],

        "footbreak alarm" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Footbreak alarm",
        ],

        "T:" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "High temperature alarm",
        ],

        "oil" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Low fuel alarm",
        ],

        "DTC" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Diagnostic problem in terminal",
        ],

        "service" => [
            "job" => \App\Jobs\LogTrackerAlarm::class,
            "description" => "Vehicle maintenance notification",
        ]
    ],

    "send_command" => [

        \App\Events\TrackingEnabled::class => "**,imei:%s,C,10s",

        \App\Events\TrackingDisabled::class => "**,imei:%s,D",

        \App\Events\EngineStopped::class => "**,imei:%s,J",

        \App\Events\EngineResumed::class => "**,imei:%s,K",

    ]
];
