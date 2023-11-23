<?

class HeaderC extends FPDF {
    function Header (){
        $this->SetFont('helvetica', 'B', 20); 
        $this->SetTextColor (100,100,100);
        $this->Image("./Logo.jpg", 10,20, 70, 50);
        $this->SetY(40);
        $this->SetX(100);
        $this->Write(5,"Raul Ferrero Vicente");
        $this->Ln();
        $this->Ln();
        $this->SetFont('helvetica','', 20); 
        $this->SetX(100);
        $this->SetFontSize(13);
        $this->SetX(100);
        $this->Write(5,"CIF: A456436");
        $this->Ln();
        $this->SetX(100);
        $this->Write(5,"Avenida de Requejo s/n");
        $this->Ln();
        $this->SetX(100);
        $this->Write(5,"49022 Zamora");
        $this->Ln();
        $this->SetX(100);
        $this->Write(5,"www.raulferrero.es");
        $this->SetLineWidth(2.3);
        $this->SetDrawColor(256,150,40);
        $this->Line(93,69,93,35);
    
        $this->Ln();

    }

    
    function Footer (){


    }

}