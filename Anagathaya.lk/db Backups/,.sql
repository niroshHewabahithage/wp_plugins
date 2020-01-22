SELECT 
    far.id as service_id
FROM
    financial_aid_requests far
        LEFT JOIN
    patients p ON far.patients_id = p.id
    where p.nicNumber='9408313936' OR p.gurdien_nic='9408313936'