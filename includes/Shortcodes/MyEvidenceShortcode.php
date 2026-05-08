<?php
namespace Spectrum\Evidence\Shortcodes;

use Spectrum\Evidence\Core\Assets;
use Spectrum\Evidence\Core\Auth;
use Spectrum\Evidence\Core\Notices;
use Spectrum\Evidence\Core\View;

use Spectrum\Evidence\Repositories\EvidenceRepository;
use Spectrum\Evidence\Repositories\LogRepository;
use Spectrum\Evidence\Services\ExportService;

if (!defined('ABSPATH')) exit;

final class MyEvidenceShortcode {
  public static function render() {
    if (!Auth::isLoggedIn()) return '<p>Silakan login untuk melihat evidence Anda.</p>';
    if (!Auth::isUnitKnown()) return '<p>Akun Anda belum memiliki fungsi/unit. Hubungi admin.</p>';
    Assets::enqueueOnce();

    $user_id = Auth::userId();
    $user = wp_get_current_user();

    $filters = array(
      'year' => isset($_GET['f_year']) ? (int)$_GET['f_year'] : (isset($_GET['year']) ? (int)$_GET['year'] : 0),
      'status' => isset($_GET['f_status']) ? sanitize_text_field($_GET['f_status']) : (isset($_GET['status']) ? sanitize_text_field($_GET['status']) : ''),
      'sdg_number' => isset($_GET['f_sdg']) ? (int)$_GET['f_sdg'] : (isset($_GET['sdg_number']) ? (int)$_GET['sdg_number'] : 0),
      'keyword' => isset($_GET['q']) ? sanitize_text_field($_GET['q']) : (isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : ''),
    );

    $allowed_status = array('DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED');
    if (!in_array($filters['status'], $allowed_status, true)) {
      $filters['status'] = '';
    }

    $rows = EvidenceRepository::findBySubmitterFiltered($user_id, $filters);
    if (!empty($_GET['export']) && $_GET['export'] === 'csv') {
      $export_rows = array();
      foreach ((array)$rows as $r) {
        $attachment_url = !empty($r->attachment_id) ? wp_get_attachment_url((int)$r->attachment_id) : '';
        $evidence_link = !empty($r->link_url) ? $r->link_url : $attachment_url;
        $export_rows[] = array(
          'sdg_number' => (int)($r->sdg_number ?? 0),
          'metric_code' => $r->metric_code ?? '',
          'metric_title' => $r->metric_title ?? '',
          'metric_question' => $r->metric_question ?? '',
          'judul_evidence' => $r->title ?? '',
          'number_evidence' => isset($r->numeric_value) ? $r->numeric_value : '',
          'score' => self::extractScore((int)($r->id ?? 0)),
          'attachment_or_link' => $evidence_link ?: '',
          'ringkasan_evidence' => $r->summary ?? '',
          'status' => $r->status ?? '',
        );
      }
      ExportService::outputCsv(
        'my-evidence-' . date('Ymd-His') . '.csv',
        array('sdg_number', 'metric_code', 'metric_title', 'metric_question', 'judul_evidence', 'number_evidence', 'score', 'attachment_or_link', 'ringkasan_evidence', 'status'),
        $export_rows
      );
    }

    return View::render('my-evidence', array(
      'notice' => Notices::get($user_id),
      'email'  => $user->user_email,
      'filters' => $filters,
      'years' => EvidenceRepository::distinctYearsBySubmitter($user_id),
      'rows'   => $rows,
    ));
  }

  private static function extractScore($evidence_id) {
    if ($evidence_id <= 0) return '';
    $logs = LogRepository::listByEvidence($evidence_id);
    foreach ((array)$logs as $log) {
      $notes = (string)($log->notes ?? '');
      if (preg_match('/Score\s*:\s*(\d+)\s*\/\s*5/i', $notes, $m)) {
        return $m[1] . '/5';
      }
    }
    return '';
  }
}
