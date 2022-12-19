<?php

/**
 * Stats controller
 */
class StatsController extends BaseController
{
    const INDEX_LAYOUT = 'layout';

	/**
	 * Perform base initialization
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct(self::INDEX_LAYOUT);
	}

    /**
	 * Handles URL: /stats/{pw}
	 * 
	 * @param Asatru\Controller\ControllerArg $request
	 * @return Asatru\View\ViewHandler
	 */
	public function index($request)
	{
		if ($request->arg('pw') !== env('APP_STATSPASSWORD')) {
			throw new Exception('Invalid password');
		}

		$start = date('Y-m-d', strtotime('-30 days'));
		$end = date('Y-m-d', strtotime('-1 day'));

		$predefined_dates = [
			'Last week' => date('Y-m-d', strtotime('-7 days')),
			'Last two weeks' => date('Y-m-d', strtotime('-14 days')),
			'Last month' => date('Y-m-d', strtotime('-1 month')),
			'Last three months' => date('Y-m-d', strtotime('-3 months')),
			'Last year' => date('Y-m-d', strtotime('-1 year')),
			'Lifetime' => date('Y-m-d', strtotime(HitsModel::getInitialStartDate()))
		];

		return parent::view([
			['content', 'stats'],
		], [
			'render_stats_to' => 'hits-stats',
			'render_stats_start' => $start,
			'render_stats_end' => $end,
			'render_stats_pw' => $request->arg('pw'),
			'predefined_dates' => $predefined_dates
		]);
	}

    /**
	 * Handles URL: /stats/query/{pw}
	 * 
	 * @param Asatru\Controller\ControllerArg $request
	 * @return Asatru\View\JsonHandler
	 */
	public function query($request)
	{
        try {
            if ($request->arg('pw') !== env('APP_STATSPASSWORD')) {
                throw new Exception('Invalid password');
            }

            $start = $request->params()->query('start', '');
			if ($start === '') {
				$start = date('Y-m-d', strtotime('-30 days'));
			}

			$end = $request->params()->query('end', '');
			if ($end === '') {
				$end = date('Y-m-d', strtotime('-1 day'));
			}
            
			$data = [];
            $data[HitsModel::HITTYPE_MODULE_APP] = [];
            $data[HitsModel::HITTYPE_MODULE_SERVER] = [];
            $data[HitsModel::HITTYPE_MODULE_USER] = [];
			$data[HitsModel::HITTYPE_MODULE_WORKSHOP] = [];
			$data[HitsModel::HITTYPE_MODULE_GROUP] = [];

			$hits = HitsModel::getHitsPerDay($start, $end);
            
			$dayDiff = (new DateTime($end))->diff((new DateTime($start)))->format('%a');

			$count_total = [];
			$count_total[HitsModel::HITTYPE_MODULE_APP] = 0;
            $count_total[HitsModel::HITTYPE_MODULE_SERVER] = 0;
            $count_total[HitsModel::HITTYPE_MODULE_USER] = 0;
			$count_total[HitsModel::HITTYPE_MODULE_WORKSHOP] = 0;
			$count_total[HitsModel::HITTYPE_MODULE_GROUP] = 0;

			for ($i = 0; $i < $hits->count(); $i++) {
				$count_total[$hits->get($i)->get('hittype')] += $hits->get($i)->get('count');

				$data[$hits->get($i)->get('hittype')][$hits->get($i)->get('created_at')][] = $hits->get($i)->get('count');
			}

			$referrers = HitsModel::getReferrers($start, $end);

			$refar = [];
			foreach ($referrers as $ref) {
				$refar[] = $ref->get('referrer');
			}

            return json([
                'code' => 200,
                'data' => $data,
				'counts' => $count_total,
				'count_total' => $count_total[HitsModel::HITTYPE_MODULE_APP] + $count_total[HitsModel::HITTYPE_MODULE_SERVER] + $count_total[HitsModel::HITTYPE_MODULE_USER] + $count_total[HitsModel::HITTYPE_MODULE_WORKSHOP] + $count_total[HitsModel::HITTYPE_MODULE_GROUP],
                'referrers' => $refar,
				'start' => $start,
				'end' => $end,
				'day_diff' => $dayDiff
            ]);
        } catch (Exception $e) {
            return json([
                'code' => 500,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
