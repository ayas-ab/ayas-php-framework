<?php
namespace Classes\Helpers\Html;
/*
Jquery validation library wrapper
need more work, such as adding custom error messages.

*/
class Jquery_validation
{

    private $form_id;

    private $rule_objects = [];

    public function __construct($form_id)
    {
        $this->form_id = $form_id;
    }

//     public function add_rule(Rules ...$rule)
//     {
//         foreach ($rule as $r) {
//             $this->rule_objects[] = $r;
//         }
//     }

    public function getJs()
    {
        $rules = "";

        foreach ($this->rule_objects as $r) {
            $rules .= $r->getJS() . ', ';
        }

        $rules = substr_replace($rules, "", - 1);

        $js = $this->generateTemplate($this->form_id);
        $js = str_replace('[rules]', $rules, $js);

        return $js;
    }

    private function generateTemplate($form_id): string
    {
        $output = '<script>$(document)
		.ready(
				function() {
					$("' . $form_id . '")
							.validate(
									{
										
										submitHandler: function(form) {
										    form.submit();
										  },
										rules : {
											[rules]

										},
										messages : {
                                   
										
										},
										errorElement : "em",
										errorPlacement : function(error,
												element) {
											
											error.addClass("invalid-feedback");

											if (element.prop("type") === "checkbox") {
												error.insertAfter(element
														.next("label"));
											} else {
												error.insertAfter(element);
											}
										},
										highlight : function(element,
												errorClass, validClass) {
											$(element).addClass("is-invalid")
													.removeClass("is-valid");
										},
										unhighlight : function(element,
												errorClass, validClass) {
											$(element).addClass("is-valid")
													.removeClass("is-invalid");
										}
									});

				}); </script>';

        return $output;
    }
	
	public function addRule($field_name) : Rules
	{
		$this->rule_objects[] = new Rules($field_name);
		
		return $this->rule_objects[sizeof($this->rule_objects)-1];
		
    }
}

class Rules
{

    private $output = "";

    function __construct($field_name)
    {
        $this->output .= $field_name . ': {';
    }

    public function required($stat)
    {
        $this->output .= 'required: true,';

        return $this;
    }

    public function minlength($s)
    {
        $this->output .= 'minlength: ' . $s . ',';
        return $this;
    }

    public function maxlength($s)
    {
        $this->output .= 'maxlength: ' . $s . ',';

        return $this;
    }

    public function lettersonly()
    {
        $this->output .= 'lettersonly: true,';

        return $this;
    }

    public function max($m)
    {
        $this->output .= 'max: ' . $m . ',';
        return $this;
    }

    public function min($m)
    {
        $this->output .= 'min: ' . $m . ',';
        return $this;
    }

    public function isEmail()
    {
        $this->output .= 'email: true,';
        return $this;
    }

    public function isDigit()
    {
        $this->output .= ' digits: true,';
        return $this;
    }
    
    public function isNumber()
    {
        $this->output .= 'number: true,';
    }

    public function normalizer()
    {
        $this->output .= 'normalizer: function(value) {
													return $.trim(value);
												},';
        return $this;
    }
    
    public function equalsTo($id)
    {
        $this->output .= 'equalTo: "'.$id.'",';
        return $this;
    }

    public function range($a, $b)
    {
        $this->output.= 'range: ['.$a.', '.$b.'],';
        return $this;
    }
    
    public function remote($url)
    {
        $this->output .= 'remote : {
					url : "'.$url.'",
					type : "post",
					dataType : "json",

				},';
        
        return $this;
    }
    
    public function isDate()
    {
        $this->output .= 'dateISO: true,';
        return $this;
    }
    
    public function isUrl()
   
    {
        $this->output .= 'url: true,';
        return $this;
    }
    
    
    public function getJs()
    {
        return substr_replace($this->output, "", - 1) . '}';
    }
}

?>