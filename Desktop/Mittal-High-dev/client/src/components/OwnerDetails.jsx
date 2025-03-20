const mysql = require('mysql');

const con = mysql.createConnection({
  host: 'localhost',
  user: 'your_user',
  password: 'your_password',
  database: 'dbms_project'
});

con.connect((err) => {
  if (err) {
    console.error('Connection failed:', err);
    return;
  }
  console.log('database Connected!');
});

function createOwner(nom, age, idProprietaire, numeroChambre, motDePasse, statutAccord, dateNaissance, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sqlOwners = "INSERT INTO owners (name, age, owner_id, room_no, aggrement_status, dob) VALUES (?, ?, ?, ?, ?, ?)";
  const valuesOwners = [nom, age, idProprietaire, numeroChambre, statutAccord, dateNaissance];

  con.query(sqlOwners, valuesOwners, (err, result) => {
    if (err) {
      console.error('Query error (owners):', err.sqlMessage);
      return callback(err, null);
    }

    const ownerId = result.insertId;
    const sqlAuth = "INSERT INTO auth (user_id, password) VALUES (?, ?)";
    const valuesAuth = [idProprietaire, motDePasse];

    con.query(sqlAuth, valuesAuth, (errAuth, resultAuth) => {
      if (errAuth) {
        console.error('Query error (auth):', errAuth.sqlMessage);
        con.query("DELETE FROM owners WHERE id = ?", [ownerId], (rollbackErr) => {
          if (rollbackErr) {
            console.error('Rollback error:', rollbackErr.sqlMessage);
          }
          callback(errAuth, null);
        });
        return;
      }

      callback(null, result);
    });
  });
}

function createtenant(values, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sql = "INSERT INTO tenants (tenant_id, name, dob, room_no, age) VALUES (?, ?, ?, ?, ?)";
  con.query(sql, values, (err, result) => {
    if (err) {
      console.error('Query error (createtenant):', err.sqlMessage);
      return callback(err, null);
    }
    callback(null, result);
  });
}

function createtenantproof(values, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sql = "INSERT INTO tenant_proof (adhaar, tenant_id) VALUES (?, ?)";
  con.query(sql, values, (err, result) => {
    if (err) {
      console.error('Query error (createtenantproof):', err.sqlMessage);
      return callback(err, null);
    }
    callback(null, result);
  });
}

function createuserid(values, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sql = "INSERT INTO auth (user_id, password, tenant_id) VALUES (?, ?, ?)";
  con.query(sql, values, (err, result) => {
    if (err) {
      console.error('Query error (createuserid):', err.sqlMessage);
      return callback(err, null);
    }
    callback(null, result);
  });
}

function deleteowner(userId, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sql = "DELETE FROM owners WHERE owner_id = ?";
  con.query(sql, [userId], (err, result) => {
    if (err) {
      console.error('Query error (deleteowner):', err.sqlMessage);
      return callback(err, null);
    }
    callback(null, result);
  });
}

// Add the getdata function
function getdata(table, callback) {
  if (typeof callback !== 'function') {
    console.error('Callback is not a function:', callback);
    throw new Error('Callback must be a function');
  }

  const sql = `SELECT * FROM ${table}`; 
  con.query(sql, (err, result) => {
    if (err) {
      console.error(`Query error (getdata - ${table}):`, err.sqlMessage);
      return callback(err, null);
    }
    callback(null, result);
  });
}

module.exports = {
  createOwner,
  createtenant,
  createtenantproof,
  createuserid,
  deleteowner,
  getdata, // Export the getdata function
  con
};