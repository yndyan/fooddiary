<?php

class Migration_Create_groceries extends CI_Migration
{   
     private $default_groceries = array(    
        ['foodname' => "mleko"],
        ['foodname' => "secer"],
        ['foodname' => "belo brasno"],
        ['foodname' => "nes kafa"],
        ['foodname' => "grasak"],
        ['foodname' => "kupus"],
        ['foodname' => "jabuke"],
        ['foodname' => "jaja"],
        ['foodname' => "mladi sir"],
        ['foodname' => "slanina"],
        ['foodname' => "rogac"],
        ['foodname' => "mlevena kafa"],
        ['foodname' => "kiselo mleko"],
        ['foodname' => "pavlaka"],
        ['foodname' => "dimljena prsa"],
        ['foodname' => "kecap"],
        ['foodname' => "majonez"],
        ['foodname' => "crni luk"],
        ['foodname' => "beli luk"],
        ['foodname' => "kratsavci"],
        ['foodname' => "kiseli krastavci"],
        ['foodname' => "sargarepa"],
        ['foodname' => "krompir"],
        ['foodname' => "praziluk"],
        ['foodname' => "sampinjoni"],
        ['foodname' => "testenina"],
    );
    
    public function up(){
        $this->dbforge->add_field(array(
                
                'groceries_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'foodname' => array(
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
        $this->dbforge->add_key('groceries_id',TRUE);
        $this->dbforge->create_table('groceries');
        
        $this->dbforge->add_field(array(
                
                'groceries_id' => array(
                                'type' => 'tinyint',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
                                'null'  => false
                                ),
                'foodname' => array(
                                'type' => 'varchar',
                                'constraint'=> 100,
                                'null' => false
                                ),
                
        ));
        $this->dbforge->add_key('groceries_id',TRUE);
        $this->dbforge->create_table('default_groceries');
        $this->db->insert_batch('default_groceries',  $this->default_groceries );


    }//up
    
    public function down(){
                $this->dbforge->drop_table('groceries');
                $this->dbforge->drop_table('default_groceries');
        
    }//down
    
    
}
