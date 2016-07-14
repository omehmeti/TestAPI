<?php

namespace App\Admin\Definitions;

use App\Admin\Interfaces\BonusRuleInterface;

class BonusRule implements BonusRuleInterface
{



    public function matchBonusRule()
    {

        return 'Houston, we have a problem here';

    }

}

/*
	"activity_seq_id": 1,
	"user_id": 1,
	"activity_type": "",
	"activity_date": "2016-06-01",
	"partner_code": "Baumbach, Kling and ",
	"partner_activity_classification_code": "ISTIKBAL0",
	"points": 10,
	"definition": "Test definition",
	"status": "AC",
	"reference": "",
	"expire_processed": "F",
	"expire_date": "2019-06-24",
	"sales_values": 100,
	"currency_code": "EUR",
	"adjustment_code": "M",
	"is_transfered": "F",
	"used_all": "F",
	"used_points": 0,
	"sales_agent_id": "",
	"rule_code": "",
	"created_at": null,
	"updated_at": null
*/