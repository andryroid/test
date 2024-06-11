import logo from './logo.svg';
import './App.css';
import { HydraAdmin } from "@api-platform/admin"; 

function App() {
  return (
    <HydraAdmin entrypoint="http://localhost:8000/api" />
  );
}

export default App;
