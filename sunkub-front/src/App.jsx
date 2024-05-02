import './App.css'
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom'
import { Auth } from './pages/auth'

function App() {
  return (
    <div className="App">
    <Router>
    <Routes>
        <Route path='/auth' element={<Auth/>}> </Route>
    </Routes>
  </Router>
 </div>
  )
}

export default App
