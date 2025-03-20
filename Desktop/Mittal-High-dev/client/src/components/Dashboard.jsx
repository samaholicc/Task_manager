import axios from "axios";
import React, { useContext, useState, useEffect } from "react";
import { HamContext } from "../HamContextProvider";

function Dashboard(props) {
  const { hamActive, hamHandler } = useContext(HamContext);
  const [forBox, setForBox] = useState();

  const getBoxInfo = async () => {
    const whom = JSON.parse(window.localStorage.getItem("whom")).userType;
    try {
      const res = await axios.post(`http://localhost:5000/dashboard/${whom}`, {
        userId: JSON.parse(window.localStorage.getItem("whom")).username,
      });
      if (whom === "admin") {
        const forAdminBox = [
          { "Total Owner": 59 },
          { "Total Tenant": 39 },
          { "Total Employee": 20 },
        ];
        forAdminBox[0]["Total Owner"] = res.data.totalowner;
        forAdminBox[2]["Total Employee"] = res.data.totalemployee;
        forAdminBox[1]["Total Tenant"] = res.data.totaltenant;
        setForBox(forAdminBox);
      }
      if (whom === "owner") {
        const forOwnerBox = [
          { "No of Emloyees": 5 },
          // { "Total Tenant": 4 },
          { "Total complaints": 2 },
        ];
        forOwnerBox[0]["No of Emloyees"] = res.data.totalemployee;
        // forOwnerBox[1]["Total Tenant"] = res.data.totaltenant;
        forOwnerBox[1]["Total complaints"] = res.data.totalcomplaint;
        setForBox(forOwnerBox);
      }
      if (whom === "employee") {
        const forEmployeeBox = [
          { "Total complaints": 31 },
          { Salary: "Rs. 20,0000" },
        ];
        forEmployeeBox[0]["Total complaints"] = res.data.totalcomplaint;
        forEmployeeBox[1].Salary = "Rs. " + res.data.salary;
        setForBox(forEmployeeBox);
      }
      if (whom === "tenant") {
        const forTenantBox = [
          { "tenant id": 12132 },
          { "Tenant Name": "Tharun" },
          { "Tenant age": 20 },
          { dob: "12-1-2002" },
          { "Room no": 123456 },
        ];
        forTenantBox[0]["tenant id"] = res.data[0].tenant_id;
        forTenantBox[1]["Tenant Name"] = res.data[0].name;
        forTenantBox[2]["Tenant age"] = res.data[0].age;
        forTenantBox[3].dob = res.data[0].dob;
        forTenantBox[4]["Room no"] = res.data[0].room_no;
        setForBox(forTenantBox);
      }
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    getBoxInfo();
  }, []);

  return (
    <div
      onClick={() => {
        if (hamActive === true) {
          hamHandler();
        }
      }}
      style={{
        filter: hamActive ? "blur(2px)" : "blur(0px)",
      }}
      className="w-screen background"
    >
      <div className="grid grid-cols-2 md:grid-cols-4 grid-rows-2 md:grid-rows-2 gap-5 p-10">
        {forBox &&
          forBox.map((ele, index) => {
            return (
              <div key={index + 1} className=" p-3 card pl-10">
                <h1 className="font-bold text-2xl ">
                  {Object.values(forBox[index])}
                </h1>
                <p className="font-bold text-sm capitalize text-gray-500">
                  {Object.keys(forBox[index])}
                </p>
              </div>
            );
          })}
      </div>
      <div className="p-10 -mt-14">
        <div className=" card p-5 ">
          <div>
            <h1 className="text-center font-semibold text-2xl">
              Règles et Réglementations de l'Appartement {/* Translated "Apartment Rules and Regulation" to "Règles et Réglementations de l'Appartement" */}
            </h1>
          </div>
          <ol className="list-[inherit] px-6 py-2 text-gray-500">
            <li>Les résidents sont encouragés à entretenir les lieux avec soin et à signaler rapidement tout problème.</li>
            <li>Le respect de la vie privée des voisins et de leur jouissance paisible de leur espace est primordial.</li>
            <li>Les paiements de loyer sont dus à la date spécifiée pour assurer un environnement de vie harmonieux pour tous.</li>
            <li>Toute modification de l'appartement nécessite une approbation écrite de l'administration.</li>
            <li>Il est conseillé aux résidents de souscrire une assurance appropriée pour leurs biens personnels.</li>
            <li>Les dépôts de garantie seront remboursés rapidement après vérification que les lieux sont exempts de dommages au départ.</li>
            <li>Les résidents doivent s'abstenir de manipuler les systèmes de chauffage, d'éclairage ou autres systèmes du bâtiment.</li>
            <li>Le stationnement est limité aux zones désignées délimitées par des lignes jaunes pour la commodité de tous les résidents.</li>
            <li>Les articles sanitaires doivent être éliminés correctement, enveloppés et placés avec les autres déchets.</li>
            <li>Les résidents sont responsables de sécuriser les fenêtres pendant les intempéries pour leur sécurité.</li>
            <li>La sécurité des femmes est une priorité, et des mesures sont en place pour garantir un environnement de vie sûr et confortable pour tous.</li>
            <li>L'administration s'engage à favoriser une atmosphère de chez-soi loin de chez soi, en priorisant le bien-être et la satisfaction de tous les résidents.</li>
          </ol>
        </div>
      </div>
    </div>
  );
}

export default Dashboard; // Translated "Dashboard" to "TableauDeBord"