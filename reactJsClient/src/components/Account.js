import React from "react";
import AuthService from "../services/auth.service";
import axios from "axios";
import { useEffect, useState } from "react";

const Account = () => {
    const [accounts, setAccounts] = useState('');
    const [error, setError] = useState(false);
    const [state, setState] = useState('');

    useEffect(() => {
        setState('loading');
        var token = "Bearer " + localStorage.getItem("token");


        axios
        .get(AuthService.getApiUrl() + 'account/currentUserAccount',{
          headers: {
            'Authorization': token.replace("\"", "")
          }
        })
        .then((response) => {
          setState('success');
          var data = JSON.parse(JSON.stringify(response.data));
          setAccounts(data);
        }).catch((err) => {
          console.error('Error:', err);
          setState('error');
          setError(err);
        });
      

    }, []);

    if (state === 'error')
    return (
        <h1>
            {error.toString()}
        </h1>
    );

    const results = [];

    if (
      typeof accounts === 'object' &&
      !Array.isArray(accounts) &&
      accounts !== null
  ){
    for (const account of accounts.data) {
      console.log(account);
        results.push(
        <div>
          <h4>Name: </h4> {account.name}
          <h4>Balance: </h4> {account.balance}
  
          <hr />
        </div>,
      );
    }
  }

    return (
      <div className="container">
        <header className="jumbotron">
          <h3>
            Account
          </h3>
        </header>
        {state === 'loading' ? (
                    <h1>Loading...</h1>
                ) : (
                  <div>

                     {results}
                  </div>
                    
                )}
      </div>
    );
};

export default Account;
