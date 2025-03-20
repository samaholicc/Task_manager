import React from "react";
import { ToastContainer } from "react-toastify"; // Import ToastContainer
import "react-toastify/dist/ReactToastify.css";
import { Routes, Route } from "react-router-dom";
import Header from "./components/Header";
import Dashboard from "./components/Dashboard";
import Aside from "./components/Aside";
import Auth from "./components/Auth";
import OwnerDetails from "./components/OwnerDetails";
import TenantDetails from "./components/TenantDetails";
import CreatingOwner from "./components/CreatingOwner";
import CreatingParkingSlot from "./components/CreatingParkingSlot";
import ComplaintsViewer from "./components/ComplaintsViewer";
import RaisingComplaints from "./components/RaisingComplaints";
import ParkingSlot from "./components/ParkingSlot";
import PayMaintenance from "./components/PayMaintenance";
import CreatingTenant from "./components/CreatingTenant";
import RoomDetails from "./components/RoomDetails";
import ErrorPage from "./ErrorPage";
import ComplaintsViewerOwner from "./components/ComplaintsViewerOwner";
import RoomDetailsOwner from "./components/RoomDetailsOwner";

function App() {
  // Sidebar
  const forAdmin = [
    "Accueil",
    "Owner Details", // Temporarily English to avoid breaking existing logic
    "Détails des propriétaires",
    "Créer un propriétaire",
    "Attribution d'emplacement de parking",
    "Plaintes",
  ];
  const forEmployee = ["Accueil", "Plaintes"];
  const forTenant = [
    "Accueil",
    "Soulever une plainte",
    "Emplacement de parking attribué",
    "Payer l'entretien",
  ];
  const forOwner = [
    "Accueil",
    "Détails des locataires",
    "Plainte",
    "Créer un locataire",
    "Détails de la chambre",
  ];

  // Mapping French menu items to English route paths
  const routeMap = {
    "détailsdespropriétaires": "ownerdetails",
    "détailsdeslocataires": "tenantdetails",
    "créerunpropriétaire": "createowner",
    "attributiond'emplacementdeparking": "allottingparkingslot",
    "plaintes": "complaints",
    "souleveruneplainte": "raisingcomplaints",
    "emplacementdeparkingattribué": "allotedparkingslot",
    "payerl'entretien": "paymaintenance",
    "plainte": "complaint",
    "créerunlocataire": "createtenant",
    "détailsdelachambre": "roomdetails",
  };

  // Function to get the correct route path
  const getRoutePath = (base, item) => {
    if (item === "Accueil") return `/${base}`;
    const key = item.replace(/\s/g, "").toLowerCase();
    return `/${base}/${routeMap[key] || key}`;
  };

  return (
    <div className="App font-mons background">
      <Routes>
        <Route path="/" element={<Auth />} />
        <Route
          path="/admin"
          element={
            <main>
              <Header forHam={[...forAdmin, "Déconnexion"]} />
              <section className="flex">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <Dashboard />
              </section>
            </main>
          }
        />
        <Route
          path="/employee"
          element={
            <main>
              <Header forHam={[...forEmployee, "Déconnexion"]} />
              <section className="flex">
                <Aside forHam={forEmployee} base="employee" getRoutePath={getRoutePath} />
                <Dashboard />
              </section>
            </main>
          }
        />
        <Route
          path="/tenant"
          element={
            <main>
              <Header forHam={[...forTenant, "Déconnexion"]} />
              <section className="flex">
                <Aside forHam={forTenant} base="tenant" getRoutePath={getRoutePath} />
                <Dashboard />
              </section>
            </main>
          }
        />
        <Route
          path="/owner"
          element={
            <main>
              <Header forHam={[...forOwner, "Déconnexion"]} />
              <section className="flex">
                <Aside forHam={forOwner} base="owner" getRoutePath={getRoutePath} />
                <Dashboard />
              </section>
            </main>
          }
        />
        <Route
          path="/admin/ownerdetails"
          element={
            <main>
              <Header forHam={forAdmin} />
              <section className="dashboardSkeleton">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <OwnerDetails />
              </section>
            </main>
          }
        />
        <Route
          path="/admin/tenantdetails"
          element={
            <main>
              <Header forHam={forAdmin} />
              <section className="dashboardSkeleton">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <TenantDetails />
              </section>
            </main>
          }
        />
        <Route
          path="/admin/createowner"
          element={
            <main>
              <Header forHam={forAdmin} />
              <section className="dashboardSkeleton">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <CreatingOwner />
              </section>
            </main>
          }
        />
        <Route
          path="/admin/allottingparkingslot"
          element={
            <main>
              <Header forHam={forAdmin} />
              <section className="dashboardSkeleton">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <CreatingParkingSlot />
              </section>
            </main>
          }
        />
        <Route
          path="/admin/complaints"
          element={
            <main>
              <Header forHam={forAdmin} />
              <section className="dashboardSkeleton">
                <Aside forHam={forAdmin} base="admin" getRoutePath={getRoutePath} />
                <ComplaintsViewer />
              </section>
            </main>
          }
        />
        <Route
          path="/tenant/raisingcomplaints"
          element={
            <main>
              <Header forHam={forTenant} />
              <section className="dashboardSkeleton">
                <Aside forHam={forTenant} base="tenant" getRoutePath={getRoutePath} />
                <RaisingComplaints />
              </section>
            </main>
          }
        />
        <Route
          path="/tenant/allotedparkingslot"
          element={
            <main>
              <Header forHam={forTenant} />
              <section className="dashboardSkeleton">
                <Aside forHam={forTenant} base="tenant" getRoutePath={getRoutePath} />
                <ParkingSlot />
              </section>
            </main>
          }
        />
        <Route
          path="/tenant/paymaintenance"
          element={
            <main>
              <Header forHam={forTenant} />
              <section className="dashboardSkeleton">
                <Aside forHam={forTenant} base="tenant" getRoutePath={getRoutePath} />
                <PayMaintenance />
              </section>
            </main>
          }
        />
        <Route
          path="/owner/tenantdetails"
          element={
            <main>
              <Header forHam={forOwner} />
              <section className="dashboardSkeleton">
                <Aside forHam={forOwner} base="owner" getRoutePath={getRoutePath} />
                <RoomDetailsOwner />
              </section>
            </main>
          }
        />
        <Route
          path="/owner/complaint"
          element={
            <main>
              <Header forHam={forOwner} />
              <section className="dashboardSkeleton">
                <Aside forHam={forOwner} base="owner" getRoutePath={getRoutePath} />
                <ComplaintsViewerOwner />
              </section>
            </main>
          }
        />
        <Route
          path="/owner/createtenant"
          element={
            <main>
              <Header forHam={forOwner} />
              <section className="dashboardSkeleton">
                <Aside forHam={forOwner} base="owner" getRoutePath={getRoutePath} />
                <CreatingTenant />
              </section>
            </main>
          }
        />
        <Route
          path="/owner/roomdetails"
          element={
            <main>
              <Header forHam={forOwner} />
              <section className="dashboardSkeleton">
                <Aside forHam={forOwner} base="owner" getRoutePath={getRoutePath} />
                <RoomDetails />
              </section>
            </main>
          }
        />
        <Route
          path="/employee/complaints"
          element={
            <main>
              <Header forHam={forEmployee} />
              <section className="dashboardSkeleton">
                <Aside forHam={forEmployee} base="employee" getRoutePath={getRoutePath} />
                <ComplaintsViewer />
              </section>
            </main>
          }
        />
        <Route
          path="/*"
          element={
            <main>
              <ErrorPage />
            </main>
          }
        />
      </Routes>
    </div>
  );
}

export default App;