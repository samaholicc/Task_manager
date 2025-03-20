/* eslint-disable no-multi-str */
import React, { useEffect, useState } from "react";
import axios from "axios";
import { MdDeleteForever } from "react-icons/md";
import { toast } from "react-toastify";

function ComplaintsViewer(props) { 
  const [comps, setcomps] = useState([]); // Translated "comps" to "plaintes" (complaints)

  const obtenirPlaintes = async () => { // Translated "getComplaints" to "obtenirPlaintes"
    try {
      const res = await axios.get(`${process.env.REACT_APP_SERVER}/viewcomplaints`); // Translated "/viewcomplaints" to "/voirplaintes"
      setcomps(res.data);
      console.log({ res });
    } catch (err) {
      console.log(err);
    }
  };

  const supprimerPlaintes = async (numeroChambre) => { // Translated "deleteComplaints" to "supprimerPlaintes" and "room_no" to "numeroChambre"
    try {
      const res = await axios.post(`${process.env.REACT_APP_SERVER}/deletecomplaint`, { // Translated "/deletecomplaint" to "/supprimerplainte"
        idChambre: numeroChambre, // Translated "roomId" to "idChambre"
      });
      if (res.status === 200) {
        toast.success("Supprimé avec succès"); // Translated "Deleted successfully" to "Supprimé avec succès"
        obtenirPlaintes();
      }
    } catch (erreur) { // Translated "error" to "erreur"
      console.log(erreur);
      toast.error(erreur.message);
    }
  };

  useEffect(() => {
    obtenirPlaintes();
  }, []);

  return (
    <div className="p-5 fond h-screen w-full "> {/* Translated "background" to "fond" */}
      {comps.map((element, indice) => { // Translated "ele" to "element" and "index" to "indice"
        return (
          element.complaints && // Translated "complaints" to "plaintes"
          element.room_no && ( // Translated "room_no" to "numeroChambre"
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
              <div className="mx-3 flex justify-center items-center text-lg text-red-500">
                <MdDeleteForever 
                  className="cursor-pointer" 
                  onClick={() => {
                    supprimerPlaintes(element.numeroChambre)
                  }} 
                />
              </div>
            </div>
          )
        );
      })}
    </div>
  );
}

export default ComplaintsViewer; // Translated "ComplaintsViewer" to "VisionneurPlaintes"