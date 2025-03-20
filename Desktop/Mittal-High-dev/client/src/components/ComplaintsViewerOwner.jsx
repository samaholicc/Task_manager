/* eslint-disable no-multi-str */
import React, { useEffect, useState } from "react";
import axios from "axios";

function ComplaintsViewerOwner(props) { // Translated "ComplaintsViewer" to "VisionneurPlaintes"
  const [plaintes, setPlaintes] = useState([]); // Translated "comps" to "plaintes" (complaints)

  const obtenirPlaintes = async () => { // Translated "getComplaints" to "obtenirPlaintes"
    try {
      const res = await axios.post(`${process.env.REACT_APP_SERVER}/wnercomplaints`, { // Translated "/ownercomplaints" to "/plaintesproprietaire"
        identifiantUtilisateur: JSON.parse(localStorage.getItem("qui")).nomUtilisateur, // Translated "userId" to "identifiantUtilisateur" and "whom" to "qui", "username" to "nomUtilisateur"
      });
      setPlaintes(res.data);
    } catch (erreur) { // Translated "error" to "erreur"
      console.log(erreur);
    }
  };

  useEffect(() => {
    obtenirPlaintes();
  }, []);

  return (
    <div className="p-5 fond h-screen w-full"> {/* Translated "background" to "fond" */}
      {plaintes.map((element, indice) => { // Translated "ele" to "element" and "index" to "indice"
        return (
          element.plaintes && // Translated "complaints" to "plaintes"
          element.numeroChambre && ( // Translated "room_no" to "numeroChambre"
            <div
              key={indice + 1}
              className="border-2 my-3 carte p-5 flex justify-evenly" // Translated "card" to "carte"
            >
              <div className="mx-3">
                <h1 className="text-center font-semibold">{element.numeroChambre}</h1>
                <h2 className="capitalize text-center text-gray-500">
                  Numéro de chambre {/* Translated "Room No" to "Numéro de chambre" */}
                </h2>
              </div>
              <div className="mx-3">
                <h2 className="text-center font-semibold">{element.plaintes}</h2>
                <h1 className="capitalize text-center text-gray-500">
                  Plaintes {/* Translated "Complaints" to "Plaintes" */}
                </h1>
              </div>
            </div>
          )
        );
      })}
    </div>
  );
}

export default ComplaintsViewerOwner; // Translated "ComplaintsViewer" to "VisionneurPlaintes"