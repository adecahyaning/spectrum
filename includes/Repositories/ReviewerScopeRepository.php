<?php
namespace Spectrum\Evidence\Repositories;

use Spectrum\Evidence\Core\Db;

if (!defined('ABSPATH')) exit;

final class ReviewerScopeRepository {

  public static function table() {
    return Db::table('spectrum_reviewer_scope');
  }

  public static function hasAnyScope($reviewer_id) {
    global $wpdb;
    $t = self::table();
    $found = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$t} WHERE reviewer_id=%d LIMIT 1", (int)$reviewer_id));
    return !empty($found);
  }

  public static function canReviewEvidence($reviewer_id, $evidence_id) {
    global $wpdb;
    $scope = self::table();
    $e = Db::table('spectrum_evidence');
    $em = Db::table('spectrum_evidence_metric');
    $m = Db::table('spectrum_metric');

    if (!self::hasAnyScope($reviewer_id)) return true;

    $sql = "
      SELECT 1
      FROM {$e} e
      LEFT JOIN {$em} em ON em.evidence_id = e.id
      LEFT JOIN {$m} m ON m.id = em.metric_id
      WHERE e.id = %d
        AND EXISTS (
          SELECT 1
          FROM {$scope} s
          WHERE s.reviewer_id = %d
            AND (s.unit_code IS NULL OR s.unit_code = '' OR s.unit_code = e.unit_code)
            AND (s.metric_id IS NULL OR s.metric_id = em.metric_id)
            AND (s.sdg_number IS NULL OR s.sdg_number = m.sdg_number)
        )
      LIMIT 1
    ";

    $found = $wpdb->get_var($wpdb->prepare($sql, (int)$evidence_id, (int)$reviewer_id));
    return !empty($found);
  }
}
