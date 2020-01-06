<?php
namespace Classes\Helpers\Html;

class Alerts
{

    public static function get_error_alert($error_msg)
    {
        return '<div class="alert  alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-times-circle"> </i> ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    }

    // added by ayas
    public static function get_success_alert($success_msg)
    {
        return '<div class="alert  alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-thumbs-up fa-2x"> </i> <em>' . $success_msg . '
            </em><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    }

    public static function get_warning_alert($msg)
    {
        return '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><i class="fas fa-exclamation-circle fa-2x"></i></strong> '.$msg.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
}

?>