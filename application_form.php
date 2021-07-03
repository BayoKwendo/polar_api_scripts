<div>
<form class="form-vertical" method="post" action="forms.php" disabled>
    <caption>APPLICANT DETAILS</caption>
    <input type="hidden" id="id" name="id" value="<?php echo isset($application_details->id)? $application_details->id:'-1'; ?>" />
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="agent">AGENT</label>
                <select id="agent" type="text" name="agent" placeholder="Agent" class="form-control" required >
                    <option value="WEB CLIENT" <?php echo ((isset($application_details->agent)&&$application_details->agent=='WEB CLIENT')? 'selected':''); ?> >WEB CLIENT</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="position_applied">POSITION APPLIED</label>
                <select id="position_applied" type="text" name="position_applied" class="form-control" placeholder="position" required>
                    <?php
                        
                        if($id>0){
                            if($jobs = db_get_all("SELECT job_ref, job_title FROM jobs WHERE deadline > '$now' ORDER BY job_title ASC ")){                                                  
                               foreach($jobs AS $opt){
                                    echo '<option value="'.$opt->job_ref.'+'.$opt->job_title.'"  '.((isset($application_details->position_applied)&&$application_details->position_applied==$opt->job_title)? "selected":"").'  >'.$opt->job_title.' ['.$opt->job_ref.']</option>';
                                }
                            } else {
                                echo '<option value="" > No Jobs Available </option>';
                            }
                        } else {
                            $where = $job==FALSE? '':" AND id='$job' ";
                            if($jobs = db_get_all("SELECT job_ref, job_title FROM jobs WHERE deadline > '$now' $where ORDER BY job_title ASC ")){                                                  
                                if($job==FALSE)  echo '<option value="" > -- Choose -- </option>';
                                foreach($jobs AS $opt){
                                    echo '<option value="'.$opt->job_ref.'+'.$opt->job_title.'" >'.$opt->job_title.' ['.$opt->job_ref.']</option>';
                                }
                            } else {
                                echo '<option value="" > No Jobs Available </option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="first_name" value="<?php echo isset($application_details->first_name)? $application_details->first_name:$active_user->first_name; ?>" class="form-control" placeholder="Names" readonly required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">Last Name </label>
                <input  id="last_name" type="text" name="last_name" value="<?php echo isset($application_details->last_name)? $application_details->last_name:$active_user->last_name; ?>" class="form-control" placeholder="Names" readonly required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="other_names">Other Names</label>
                <input  id="other_names" type="text" name="other_names" value="<?php echo isset($application_details->other_names)? $application_details->other_names:''; ?>" class="form-control" placeholder="Names" >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="applicant_contact">APPLICANT CONTACTS</label>
                <input id="applicant_contact" type="text" name="applicant_contact" value="<?php echo isset($application_details->applicant_contact)? $application_details->applicant_contact:'+256'; ?>"
                    class="form-control" placeholder="+256------" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="other_contact">OTHER CONTACTS</label>
                <input id="other_contact" type="text" name="other_contact" value="<?php echo isset($application_details->applicant_contact)? $application_details->other_contact:'+256'; ?>"
                    class="form-control" placeholder="+256---------">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="address">APPLICANT ADDRESS</label>
                <input id="address" type="text" name="address" value="<?php echo isset($application_details->address)? $application_details->address:''; ?>"
                    class="form-control" placeholder="address" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="father_name">FATHER'S NAME</label>
                <input type="text" name="father_name" value="<?php echo isset($application_details->father_name)? $application_details->father_name:''; ?>"
                    class="form-control" placeholder="father's name" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="father_contact">FATHER's CONTACTS</label>
                <input type="text" name="father_contact" value="<?php echo isset($application_details->father_contact)? $application_details->father_contact:'+256'; ?>"
                    class="form-control" placeholder="+256" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mother_name">MOTHER'S NAME</label>
                <input type="text" name="mother_name" value="<?php echo isset($application_details->mother_name)? $application_details->mother_name:''; ?>"
                    class="form-control" placeholder="mother's name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="mother_contact">MOTHER'S CONTACTS</label>
                <input type="text" name="mother_contact" value="<?php echo isset($application_details->mother_contact)? $application_details->mother_contact:'+256'; ?>"
                    class="form-control" placeholder="+256" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="next_of_kin">NEXT OF KIN</label>
                <input type="text" name="next_of_kin" value="<?php echo isset($application_details->next_of_kin)? $application_details->next_of_kin:''; ?>"
                    class="form-control" placeholder="next_of_kin" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="next_of_kin_contact">NEXT OF KIN CONTACTS</label>
                <input type="text" name="next_of_kin_contact" value="<?php echo isset($application_details->next_of_kin_contact)? $application_details->next_of_kin_contact:'256'; ?>"
                    class="form-control" placeholder="+256" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="county">COUNTY</label>
                <input type="text" name="county" value="<?php echo isset($application_details->county)? $application_details->county:''; ?>"
                    class="form-control" placeholder="county" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" value="<?php echo isset($application_details->date_of_birth)? $application_details->date_of_birth:''; ?>"
                    class="form-control" placeholder="D.O.B" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="id_no">ID NO</label>
                <input id="id_no" type="text" name="id_no" value="<?php echo isset($application_details->id_no)? $application_details->id_no:''; ?>"
                    class="form-control" placeholder="ID number">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="passport_number">PASSPORT NO</label>
                <input id="passport_number" type="text" name="passport_number" value="<?php echo isset($application_details->passport_number)? $application_details->passport_number:''; ?>"
                    class="form-control" placeholder="passport number" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="passport_profession">PASSPORT PROFESSION</label>
                <input id="passport_profession" type="text" name="passport_profession" value="<?php echo isset($application_details->passport_profession)? $application_details->passport_profession:''; ?>"
                    class="form-control" placeholder="passport profession">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_issuance">Date of Issue (Passport)</label>
                <input id="date_of_issuance" type="date" name="date_of_issuance" value="<?php echo isset($application_details->date_of_issuance)? $application_details->date_of_issuance:''; ?>"
                    class="form-control" placeholder="date_of_issuance" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_expiry">Date of Expiry (Passport)</label>
                <input id="date_of_expiry" type="date" name="date_of_expiry" value="<?php echo isset($application_details->date_of_expiry)? $application_details->date_of_expiry:''; ?>"
                    class="form-control" placeholder="date_of_expiry" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="religion">RELIGION</label>
                <select id="religion" type="text" name="religion" placeholder="Your Religion" class="form-control" required>
                    <?php
                        if($rel = db_get_all("SELECT * FROM religions ORDER BY religion ASC ")){                                                   
                            echo '<option value="" > ------------- </option>';
                            foreach($rel AS $opt){
                                echo '<option value="'.$opt->religion.'"  '.((isset($application_details->religion)&&$application_details->religion==$opt->religion)? "selected":"").'  >'.$opt->religion.'</option>';
                            }
                        } else {
                            echo '<option value="" > No Religion info </option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="nationality">NATIONALITY</label>
                <select id="nationality" type="text" name="nationality" placeholder="Your Nationality" class="form-control" required> 
                    <?php
                        if($ctry = db_get_all("SELECT * FROM countries ORDER BY nationality ASC ")){                                                   
                            echo '<option value="" > ------------- </option>';
                            foreach($ctry AS $opt){
                                echo '<option value="'.$opt->nationality.'"  '.((isset($application_details->nationality)&&$application_details->nationality==$opt->nationality)? "selected":"").'  >'.$opt->nationality.'</option>';
                            }
                        } else {
                            echo '<option value="" > No Country info </option>';
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="gender">GENDER</label>
                <select class="form-control" name="gender" required />
                    <option value="" <?php echo ((isset($application_details->gender)&&$application_details->gender=='')? 'selected':''); ?> > -- SELECT GENDER --</option>
                    <option value="FEMALE" <?php echo ((isset($application_details->gender)&&$application_details->gender=='FEMALE')? 'selected':''); ?> >FEMALE</option>
                    <option value="MALE" <?php echo ((isset($application_details->gender)&&$application_details->gender=='MALE')? 'selected':''); ?> >MALE</option>
                    <option value="OTHERS" <?php echo ((isset($application_details->gender)&&$application_details->gender=='OTHERS')? 'selected':''); ?> >OTHERS</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="marital_status">MARITAL STATUS</label>
                <select class="form-control" name="marital_status" required />
                    <option value="" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='')? 'selected':''); ?> > -- SELECT MARITAL STATUS
                        --</option>
                    <option value="MARRIED" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='MARRIED')? 'selected':''); ?> >MARRIED</option>
                    <option value="SINGLE" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='SINGLE')? 'selected':''); ?> >SINGLE</option>
                    <option value="DIVORCED" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='DIVORCED')? 'selected':''); ?> >DIVORCED</option>
                    <option value="WIDOWED" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='WIDOWED')? 'selected':''); ?> >WIDOWED</option>
                    <option value="OTHERS" <?php echo ((isset($application_details->marital_status)&&$application_details->marital_status=='OTHERS')? 'selected':''); ?> >OTHERS</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="date_of_application">DATE OF APPLICATION</label>
                <input id="date_of_application" type="date" name="date_of_application" value="<?php echo isset($application_details->date_of_application)? $application_details->date_of_application:''; ?>"
                    class="form-control" placeholder="date of application" required>
            </div>
        </div>
    </div>
    <div><button type="submit" name="apply_entry" class="btn1 btn-info btn-fill pull-right">SAVE</button></div>
    <div class="clearfix1"></div>
</form>
</div>