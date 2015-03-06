<?php

class Migration_Create_groceries extends CI_Migration
{   
     private $default_groceries = array(    
        ['groceryname' => "mleko"],
        ['groceryname' => "secer"],
        ['groceryname' => "belo brasno"],
        ['groceryname' => "nes kafa"],
        ['groceryname' => "grasak"],
        ['groceryname' => "kupus"],
        ['groceryname' => "jabuke"],
        ['groceryname' => "jaja"],
        ['groceryname' => "mladi sir"],
        ['groceryname' => "slanina"],
        ['groceryname' => "rogac"],
        ['groceryname' => "mlevena kafa"],
        ['groceryname' => "kiselo mleko"],
        ['groceryname' => "pavlaka"],
        ['groceryname' => "dimljena prsa"],
        ['groceryname' => "kecap"],
        ['groceryname' => "majonez"],
        ['groceryname' => "crni luk"],
        ['groceryname' => "beli luk"],
        ['groceryname' => "krastavci"],
        ['groceryname' => "kiseli krastavci"],
        ['groceryname' => "sargarepa"],
        ['groceryname' => "krompir"],
        ['groceryname' => "praziluk"],
        ['groceryname' => "sampinjoni"],
        ['groceryname' => "testenina"],
        ['groceryname' => "tunjevina u salamuri"],
        ['groceryname' => "sardina u ulju"],
    );
    
    public function up(){
        $this->dbforge->add_field(array(
                
                'grocery_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'groceryname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                
                'user_id' => array(
				'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
                                'null'  => false
                                )
        ));
        $this->dbforge->add_key('grocery_id',TRUE);
        $this->dbforge->create_table('user_groceries');
        
        $this->dbforge->add_field(array(
                
                'grocery_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'groceryname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                
        ));
        $this->dbforge->add_key('grocery_id',TRUE);
        $this->dbforge->create_table('default_groceries');
        $this->db->insert_batch('default_groceries',  $this->default_groceries );


    }//up
    
    public function down(){
                $this->dbforge->drop_table('user_groceries');
                $this->dbforge->drop_table('default_groceries');
        
    }//down
    
    
}
